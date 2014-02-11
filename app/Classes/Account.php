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
            $this->error += array("login" => "Username is invalid");
            return false;
        }
        $salt = $user->getSalt();
        $dbpassword = $user->getPassword();
        
        //Hashing the password entered by the user then checking if it is the same in the database
        //If failed then return a login failed
        $hashedpassword = hash('sha256', $salt + $password);
        
        if($dbpassword != $hashedpassword)
        {
            $this->error += array("login" => "Password is incorrect");
            return false;
        }
        
        
    }
    
    function Register($username, $passwordin, $email, $dob)
    {
        $user = new Users();
        $password = new Passwords();
        
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setDateOfBirth($dob);
        $user->setDateTime(time());
        
        //Generating a random salt and converting it to UTF
        $salt = mb_convert_encoding(mcrypt_create_iv(64, MCRYPT_DEV_URANDOM), "UTF-8", "ISO-8859-1");;
        
        //Hashing the password with sha256 with a ranom salt the password and a random generated string value.
        //If the database is compromised they will need the random string in the code.
        $hashedpassword = hash('sha256', $salt . $passwordin);
        
        $password->setPassword($hashedpassword);
        $password->setSalt($salt);
        $password->setPasswordChange(time());
        $password->setLastLogin(time());
        
        if(!($user->save()) && !($password-save()))
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
