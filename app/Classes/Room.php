<?php
class Room
{
    public $error;
    
    public function Register($title, $description, $videolink, $iconfile, $userid)
    {
        //Checking to see if any errors is set or multiple files are uploaded
        if (!isset($iconfile['error']) || is_array($iconfile['error']))
        {
            $this->error = "There is an error with the file that is uploaded";
            return false;
        }
        
        //Pattern refferenced from http://www.mkyong.com/regular-expressions/how-to-validate-image-file-extension-with-regular-expression/
        if(!preg_match("([^\\s]+(\\.(?i)(jpg|png|gif|bmp))$)", $iconfile['name']))
        {
            $this->error = "The file uploaded is not an image";
            return false;
        }
        
        //Getting the video id from the youtube link the regex code is refferenced from http://stackoverflow.com/questions/3392993/php-regex-to-get-youtube-video-id
        $videoid = "";
        if (!preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $videolink, $videoid))
        {
            $this->error = "The youtube link is invalid";
            return false;
        }
        
        //Moving the icon file from the temp location to the new location
        move_uploaded_file($iconfile['tmp_name'], "/var/www/sharpframe.co.uk/public_html/public/content/icons/".$iconfile['name']);
        
        //Adding the details to the database
        $room = new Rooms();
        $roomowner = new RoomOwners();
        
        $room->setTitle($title);
        $room->setDiscription($description);
        $room->setVideoid(array_shift($videoid));
        $room->setIcon($iconfile['name']);
        
        if(!($room->save()))
            return false;
        
        $roomowner->setRoomid((string)$room->getid());
        $roomowner->setUserid($userid);
        
        if(!($roomowner->save()))
            return false;
        
        return true;
    }
    
    public function Delete($roomid)
    {
        $room = Rooms::findFirst(array(
            array("_id" => $roomid)
        ));
        
        if($room == null)
        {
            $this->error = "Room id is invalid";
            return false;
        }
        
        $room->delete();
        
        return true;
    }
    
    public function edit($roomid, $title, $description, $videoid, $icon)
    {
        
    }
    
    public function getRoom($id)
    {
        $room = Rooms::findFirst(array(
            array("_id" => $id)
        ));
        if($room == null)
        {
            $this->error = "Room id is invalid";
            return false;
        }
        return $room;
    }
    
    public function getError()
    {
        return $this->error;
    }
}

?>
