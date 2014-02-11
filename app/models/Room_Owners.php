<?php

class Room_Owners extends \Phalcon\Mvc\Collection
{
    public $_Room_Ownerid;
    public $Userid;
    public $Roomid;
    
    public function initialize()
    {
        $this->useImplicitObjectIds(false);
    }
    
    public function setUserid($userid)
    {
        $this->Userid = mb_convert_encoding($userid, "UTF-8", "ISO-8859-1");
    }
    
    public function getUserid()
    {
        return $this->Userid;
    }
    
    public function setRoomid($roomid)
    {
        $this->Roomid = mb_convert_encoding($roomid, "UTF-8", "ISO-8859-1");
    }
    
    public function getRoomid()
    {
        return $this->Roomid;
    }
}

?>
