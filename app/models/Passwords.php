<?php
class Passwords extends \Phalcon\Mvc\Collection 
{
    
    public $Userid;
    public $password;
    public $salt;
    public $passwordChange;
    public $lastLogin;
    
    public function initialize()
    {
        $this->useImplicitObjectIds(false);
    }
    
    public function setUserid($id)
    {
        $this->Userid = $id;
    }
    
    public function getUserid()
    {
        return $this->Userid;
    }
    
    public function setPassword($password)
    {
        //Password must be over 6 characters
        if(strlen($password) < 6)
        {
            throw new \InvalidArgumentException('password is too short');
        }
        
        $this->password = $password;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
    
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }
    
    public function getSalt()
    {
        return $this->salt;
    }
    
    public function setPasswordChange($datetime)
    {
        //Converting it to UTF-8 to prevent errors with MongoDB
        $this->passwordChange = mb_convert_encoding($datetime, "UTF-8", "ISO-8859-1");
    }
    
    public function getPasswordChange()
    {
        return $this->passwordChange;
    }
    
    public function setLastLogin($datetime)
    {
        //Converting it to UTF-8 to prevent errors with MongoDB
        $this->lastLogin = mb_convert_encoding($datetime, "UTF-8", "ISO-8859-1");
    }
    
    public function getLastLogin()
    {
        return $this->lastLogin;
    }
}

?>
