<?php
class Rooms extends \Phalcon\Mvc\Collection
{
    public $_id;
    public $title;
    public $discription;
    public $videoid;
    public $icon;
    
    public function initialize()
    {
        $this->useImplicitObjectIds(false);
    }
    
    public function getid()
    {
        return $this->_id;
    }
    
    public function setTitle($title)
    {
        $this->RoomName = mb_convert_encoding($title, "UTF-8", "ISO-8859-1");
    }
    
    public function getTitle()
    {
        return $this->title;
    }
    
    public function setDiscription($discription)
    {
        $this->Discription = mb_convert_encoding($discription, "UTF-8", "ISO-8859-1");
    }
    
    public function getDiscription()
    {
        return $this->Discription;
    }
    
    public function setVideoid($id)
    {
        $this->videoid = $id;
    }
    
    public function getVideoid()
    {
        return $this->videoid;
    }
    
    public function setIcon($icon)
    {
        $this->RoomIcon = mb_convert_encoding($icon, "UTF-8", "ISO-8859-1");
    }
    
    public function getIcon()
    {
        return $this->RoomIcon;
    }
}

?>
