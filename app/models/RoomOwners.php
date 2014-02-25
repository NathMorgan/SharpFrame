<?php

class RoomOwners extends \Phalcon\Mvc\Collection
{
    public $_RoomOwnerid;
    public $Userid;
    public $Roomid;
    
    public function initialize()
    {
        $this->useImplicitObjectIds(false);
    }
    
    public function getRoomOwnerid()
    {
        return $this->_RoomOwnerid;
    }
    
    public function setUserid($userid)
    {
        $this->Userid = $userid;
    }
    
    public function getUserid()
    {
        return $this->Userid;
    }
    
    public function setRoomid($roomid)
    {
        $this->Roomid = $roomid;
    }
    
    public function getRoomid()
    {
        return $this->Roomid;
    }
}

?>
