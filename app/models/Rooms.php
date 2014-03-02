<?php
class Rooms extends \Phalcon\Mvc\Collection
{
    public $_id;
    public $title;
    public $discription;
    public $videoid;
    public $videoStartTime;
    public $videoEndTime;
    public $ownerUsername;
    public $views;
    public $connectedUsers;
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
    
    public function setVideoStartTime($time)
    {
        $this->videoStartTime = $time;
    }
    
    public function getVideoStartTime()
    {
        return $this->videoStartTime;
    }
    
    public function setVideoEndTime($time)
    {
        $this->videoEndTime = $time;
    }
    
    public function getVideoEndTime()
    {
        return $this->videoEndTime;
    }
    
    public function setOwnerUsername($username)
    {
        $this->ownerUsername = $username;
    }
    
    public function getOwnerUsername()
    {
        return $this->ownerUsername;
    }
    
    public function setViews($views)
    {
        $this->views -> $views;
    }
    
    public function getViews()
    {
        return $this->views;
    }
    
    public function setConnectedUsers($connectedusers)
    {
        $this->connectedUsers -> $connectedusers;
    }
    
    public function getConnectedUsers()
    {
        return $this->connectedUsers;
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
