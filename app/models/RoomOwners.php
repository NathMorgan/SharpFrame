<?php

class RoomOwners extends \Phalcon\Mvc\Collection
{
    public $_id;
    public $userid;
    public $roomid;
    
    public function initialize()
    {
        $this->useImplicitObjectIds(false);
    }
    
    public function getid()
    {
        return $this->_id;
    }
    
    public function setUserid($userid)
    {
        $this->userid = $userid;
    }
    
    public function getUserid()
    {
        return $this->userid;
    }
    
    public function setRoomid($roomid)
    {
        $this->roomid = $roomid;
    }
    
    public function getRoomid()
    {
        return $this->roomid;
    }
}

?>
