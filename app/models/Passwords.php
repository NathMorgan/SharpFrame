<?php
class Passwords extends \Phalcon\Mvc\Collection 
{
    
    public $_Userid;
    public $password;
    public $salt;
    public $passwordchange;
    public $lastlogin;
    
    public function initialize()
    {
        $this->useImplicitObjectIds(false);
    }
    
    public function setPassword($password)
    {
        //Password must be over 6 characters
        if(strlen($password) < 6)
        {
            throw new \InvalidArgumentException('password is too short');
        }
        
        //Generating a random salt and converting it to UTF
        $salt = mb_convert_encoding(mcrypt_create_iv(64, MCRYPT_DEV_URANDOM), "UTF-8", "ISO-8859-1");;
        
        //Hashing the password with sha256 with a ranom salt the password and a random generated string value.
        //If the database is compromised they will need the random string in the code.
        $hashedpassword = hash('sha256', $salt + $password);
        
        //Converting it to UTF-8 to prevent errors with MongoDB
        $this->password = mb_convert_encoding($hashedpassword, "UTF-8", "ISO-8859-1");
        
        setSalt($salt);
    }
    
    public function getPassword()
    {
        return $this->password;
    }
    
    public function setSalt($salt)
    {
        //Converting it to UTF-8 to prevent errors with MongoDB
        $this->salt = mb_convert_encoding($salt, "UTF-8", "ISO-8859-1");
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
