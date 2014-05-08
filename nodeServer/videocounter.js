//This code is ran on start-up of the node server

console.log("Starting the node.js server. Please wait");

var io = require('socket.io').listen(8080);
var mongoose = require('mongoose');

var db = mongoose.connect("mongodb://localhost/SharpFrame");

var roomSchema = mongoose.Schema({
    _id : mongoose.Schema.ObjectId,
    title : String,
    description : String,
    videoid : String,
    videoStartTime : Number,
    videoEndTime : Number,
    ownerUsername : String,
    views : Number,
    connectedUsers : Number,
    icon : String
});

var Room = mongoose.model('Room', roomSchema);

var videoSchema = mongoose.Schema({
    _id : mongoose.Schema.ObjectId,
    roomid : String,
    link : String,
    title : String,
    length : Number,
    isplaying : Number,
    starttime : Number,
    endtime : Number,
    hidden : Number
});

var Video = mongoose.model('Video', videoSchema);

function getRooms(callback){
    Room.find({}, function(error, data){
        rooms = data;
        callback(rooms);
    });
}

function getVideos(callback){
    Video.find({}, function(error, data){
        videos = data;
        callback(videos);
    });
}

var rooms;
var videos;

getRooms(function(data){
    var rooms = data;
});

getVideos(function (data){
    var videos = data;
});

console.log("Start-up finished");

//End of start-up code

//

var application = require('http').createServer(handler);

application.listen(7979);

function handler(req, res) {
    switch(req.url) {
        case('/updateroom/') :
            Room.find({}, function(error, data){
                console.log("Updating rooms");
                getRooms(function(data){
                    rooms = data;
                });
                res.end("true");
            });
        case('/updatevideo/') :
            Video.find({}, function(error, data){
                console.log("Updating videos");
                getVideos(function(data){
                    videos = data;
                });
                res.end("true");
            });
    }
}

//


io.sockets.on('connection', function (socket) {

    socket.on('joinroom', function (data) {

        var values = JSON.parse(data);

        //Finding the room
        rooms.forEach(function(room) {
            console.log(values.Roomid);
            if(new String(room._id) == values.Roomid) {
                console.log("Room Found!");
                socket.room = room;
                socket.join(room._id);
            }
            else
                console.log("cant find the room");
        });

        //Finding the video to the room
        videos.forEach(function(video) {
            if(video.roomid == new String(socket.room._id)) {
                if(video.isplaying == 1) {
                    socket.video = video;
                    console.log("Found the video");
                }
            }
        });

        socket.room.views = socket.room.views + 1;
        socket.room.connectedUsers = io.sockets.clients(socket.room._id).length;
        socket.room.save();
        socket.username = values.Username;
        socket.broadcast.to(socket.room._id).emit("servermessage", socket.username + " has joined");
        socket.emit("servermessage", "Welcome to " + socket.room.title)
        socket.emit("video", socket.video.link);
        var videotimearray = { "Currenttime" : Math.round((new Date()).getTime() / 1000) , "Videostarttime" : socket.video.starttime }
        socket.emit("videoTime", JSON.stringify(videotimearray));
    });

    socket.on('disconnect', function(){
        socket.broadcast.to(socket.room._id).emit('servermessage', socket.username + ' has disconected');
        socket.emit('servermessage', socket.username + ' has disconected');
    });

    socket.on('usermessage', function (data) {
        socket.broadcast.to(socket.room._id).emit('usermessage', socket.username + ': ' + data);
        socket.emit('usermessage', socket.username + ': ' + data);
    });

    setInterval(function() {
        videos.forEach(function(video){
            if(video.endtime < Math.round((new Date()).getTime() / 1000)){
                if(video.roomid == socket.room.id){
                    if(video.isplaying != 0){
                        console.log("change video");
                        ChangeVideo(video);
                    }
                }
            }
        });
        socket.emit('heartbeat', Math.round((new Date()).getTime() / 1000));
    }, 5000);

    function ChangeVideo(video) {
        //Ending the current playing video
        video.isplaying = 0;
        video.hidden = 1;

        video.save();

        Video.findOne({ roomid : video.roomid, hidden : 0, isplaying : 0}, function(err, data){
            //if data is null then no videos are found so it will repeat the currently played one
            if(data == null) {
                console.log("No videos");
                video.isplaying = 1;
                video.hidden = 0;
                video.starttime = Math.round((new Date()).getTime() / 1000);
                video.endtime = Math.round((new Date()).getTime() / 1000) + video.length;

                video.save();

                socket.video = video;

                var videotimearray = { "Currenttime" : Math.round((new Date()).getTime() / 1000) , "Videostarttime" : video.starttime }
                socket.emit("videoTime", JSON.stringify(videotimearray));

                return
            }
            videos.forEach(function(video){
                if(video.id == data.id){
                    console.log("Found video");
                    video.isplaying = 1;
                    video.hidden = 0;
                    video.starttime = Math.round((new Date()).getTime() / 1000);
                    video.endtime = Math.round((new Date()).getTime() / 1000) + video.length;

                    video.save();

                    socket.video = video;

                    socket.emit("video", video.link);
                    var videotimearray = { "Currenttime" : Math.round((new Date()).getTime() / 1000) , "Videostarttime" : video.starttime }
                    socket.emit("videoTime", JSON.stringify(videotimearray));
                }
            });
        });

        console.log("video changed");
    }
});