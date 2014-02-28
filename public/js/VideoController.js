var playerobject;
var videoid;
var videotime;


var player = {
    playVideo: function() {
      //If the youtube player is new
      if (playerobject == null) {
        console.log("new player");
        player.loadPlayer(); 
      }
      //Else its just a change of video
      else {
          console.log("player already running");
          playerobject.loadVideoById(videoid, videotime);
          playerobject.playVideo();
      }
    },

    loadPlayer: function() {
        playerobject = new YT.Player("player", {
            width: 640,
            height: 390,
            playerVars: { 
                'autoplay' : 1, 
                'controls' : 0, 
                'disablekb' : 1, 
                'rel': 0, 
                'showinfo' : 0
            },
            events: {
                'onReady': player.onPlayerReady,
                'onStateChange': player.onStateChange
            }
      });
    },

    onPlayerReady: function() {
        console.log("player ready");
        playerobject.loadVideoById(videoid, videotime);
        playerobject.playVideo();
    },
    
    onStateChange: function(event) {
        console.log("playerchange");
        if(event.data == YT.PlayerState.ENDED){
            console.log("player finished");
            playerobject.stopVideo();
            resetVideo();
        }
        if(event.data == YT.PlayerState.PLAYING){
            playerobject.seekTo(videotime, true);
        }
    }
};

function calcVideoPosition(time){
    var videoposition = (new Date()).getTime() / 1000 - (time/1000);
    if(videoposition < 0)
    {
        videoposition = videoposition + 1;
    }
    return videoposition;
}

function resetVideo(){
    socket.emit("resettime", '');
}

function changevideo(){
    videoid = document.getElementById('video').value;
    console.log(videoid);
    socket.emit("newvideo", videoid);
    resetVideo();
}

var socket = io.connect("http://sharpframe.co.uk:9898");

socket.emit("joinroom", '{"RoomName" : "Default"}');

socket.on("video", function (data) {
    console.log("got video id: " + data);
    videoid = data;
});

socket.on("videoTime", function (data) {
    console.log("got video time");
    videotime = calcVideoPosition(data);
    player.playVideo();
});

socket.on("userchat", function (data) {
    console.log("User Chat");
});









