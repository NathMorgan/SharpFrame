<?php

class Users extends \Phalcon\Mvc\Collection
{
    public $_id;
    public $username;
    public $password;
    public $salt;
    public $email;
    public $dateofbirth;
    public $datetime;
    
    public function initialize()
    {
        $this->useImplicitObjectIds(false);
    }
    
    public function setUsername($username)
    {
        //Username must be more then 3 characters
        if(strlen($username) < 3)
        {
            throw new \InvalidArgumentException('Username is too short');
        }
        //Username also must be under 20 characters
        if(strlen($username) > 32)
        {
            throw new \InvalidArgumentException('Username is too long');
        }
        
        //Converting it to UTF-8 to prevent errors with MongoDB
        $this->username = mb_convert_encoding($username, "UTF-8", "ISO-8859-1");
    }
    
    public function getUsername()
    {
        return $this->username;
    }
    
    public function setEmail($email)
    {
        //Password must be over 6 characters
        if(strlen($email) < 3)
        {
            throw new \InvalidArgumentException('password is too short');
        }
        
        //Converting it to UTF-8 to prevent errors with MongoDB
        $this->email = mb_convert_encoding($email, "UTF-8", "ISO-8859-1");
    }
    
    public function getEmail()
    {
        return $this->$email;
    }
    
    public function setDateOfBirth($dob)
    {
        $this->dateofbirth = $dob;
    }
    
    public function getDateOfBirth()
    {
        return $this->dateofbirth;
    }
    
    public function setDateTime($datetime)
    {
        //Converting it to UTF-8 to prevent errors with MongoDB
        $this->datetime = mb_convert_encoding($datetime, "UTF-8", "ISO-8859-1");
    }
    
    public function getDateTime()
    {
        return $this->datetime;
    }
}