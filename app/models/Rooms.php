<?php
class Rooms extends \Phalcon\Mvc\Collection
{
    public $_id;
    public $RoomName;
    public $Discription;
    public $RoomIcon;
    
    public function initialize()
    {
        $this->useImplicitObjectIds(false);
    }
    
    public function getid()
    {
        return $this->_id;
    }
    
    public function setRoomName($name)
    {
        $this->RoomName = mb_convert_encoding($name, "UTF-8", "ISO-8859-1");
    }
    
    public function getRoomName()
    {
        return $this->RoomName;
    }
    
    public function setDiscription($discription)
    {
        $this->Discription = mb_convert_encoding($discription, "UTF-8", "ISO-8859-1");
    }
    
    public function getDiscription()
    {
        return $this->Discription;
    }
    
    public function setRoomIcon($icon)
    {
        $this->RoomIcon = mb_convert_encoding($icon, "UTF-8", "ISO-8859-1");
    }
    
    public function getRoomIcon()
    {
        return $this->RoomIcon;
    }
}

?>
