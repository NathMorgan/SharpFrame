<?php
class Room
{
    public $error;
    
    public function Register($name, $description, $videoid, $roomicon, $userid)
    {
        $room = new Rooms();
        $roomOwner = new Room_Owners();
        
        $room->setRoomName($name);
        $room->setDiscription($description);
        $room->setVideoid($videoid);
        $room->setRoomIcon($roomicon);
        
        if(!($room->save()))
            return false;
        
        $roomOwner->setRoomid((string)$room->getid());
        $roomOwner->setUserid($userid);
        
        if(!($roomOwner->save()))
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
