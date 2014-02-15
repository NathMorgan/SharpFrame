<?php

class Account {
    
    private $error;
    
    function Login($username, $password)
    {
        //Trying to find a username that is provided by the user when logging in
        //If failed then return a login failed no need to check for password
        $user = Users::findFirst(array(
            array("username" => $username)
        ));
        
        if($user == null)
        {
            $this->error = array("login" => "Username is invalid");
            return false;
        }
        
        $password = Passwords::findFirst(array(
            array("Userid" => $user->getid())
        ));

        //Cant find password this should not happen but is here just incase something bad happens
        if($password == null)
        {
            $this->error = array("login" => "Password not found");
            return false;
        }
        
        $salt = $password->getSalt();
        $dbpassword = $password->getPassword();
        
        //Hashing the password entered by the user then checking if it is the same in the database
        //If failed then return a login failed
        $hashedpassword = hash('sha256', $salt + $password);
        
        if($dbpassword != $hashedpassword)
        {
            $this->error = array("login" => "Password is incorrect");
            ChromePhp::log($this->error);
            return false;
        }
        
        return true;
    }
    
    function Register($username, $passwordin, $email, $dob)
    {
        $user = new Users();
        $password = new Passwords();
        
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setDateOfBirth($dob);
        $user->setDateTime(microtime(false));
        
        if(!($user->save()))
            return false;
        
        //Generating a salt to be used with the password
        $salt =  hash('sha256', $username . microtime() . $dob . "UgcrRZFBED91yqPecEXu");
        
        //Hashing the password with sha256 with a ranom salt the password and a random generated string value.
        //If the database is compromised they will need the random string in the code.
        $hashedpassword = hash('sha256', $salt . $passwordin);
        
        $password->setUserid($user->getid());
        $password->setPassword($hashedpassword);
        $password->setSalt($salt);
        $password->setPasswordChange(microtime());
        $password->setLastLogin(microtime());
        
        if(!($password->save()))
            return false;
        
        return true;
    }
    
    function ResetPassword($newpassword, $oldpassword)
    {
        
    }
    
    function ChangeEmail($email)
    {
        
    }
    
    static function Authenticate($ip, $cookie = "")
    {
        
    }
    
    function GetError()
    {
        return $error;
    }
}

?>
