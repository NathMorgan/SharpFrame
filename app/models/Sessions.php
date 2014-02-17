<?php

class Sessions extends \Phalcon\Mvc\Collection
{
    public $_id;
    public $userid;
    public $sessionkey;
    
    public function getId()
    {
        return $this->_id;
    }
    
    public function setUserid($id)
    {
        $this->userid = $id;
    }
    
    public function getUserid()
    {
        return $this->userid;
    }
    
    public function setSessionkey($key)
    {
        $this->sessionkey = $key;
    }
    
    public function getSessionkey()
    {
        return $this->sessionkey;
    }
}

?>
