<?php
class Rooms extends \Phalcon\Mvc\Collection
{
    public $_id;
    public $title;
    public $discription;
    public $videoid;
    public $ownerUsername;
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
        $this->title = $title;
    }
    
    public function getTitle()
    {
        return $this->title;
    }
    
    public function setDiscription($discription)
    {
        $this->discription = $discription;
    }
    
    public function getDiscription()
    {
        return $this->discription;
    }
    
    public function setVideoid($id)
    {
        $this->videoid = $id;
    }
    
    public function getVideoid()
    {
        return $this->videoid;
    }
    
    public function setOwnerUsername($username)
    {
        $this->ownerUsername = $username;
    }
    
    public function getOwnerUsername()
    {
        return $this->ownerUsername;
    }
    
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }
    
    public function getIcon()
    {
        return $this->icon;
    }
}

?>
