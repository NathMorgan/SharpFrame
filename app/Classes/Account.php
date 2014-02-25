<?php

class Account {
    
    private $error;
    
    function Login($username, $passwordin, $remember, $ip)
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
            array("Userid" => (string)$user->getid())
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
        $hashedpassword = hash('sha256', $salt . $passwordin);
        
        if($dbpassword != $hashedpassword)
        {
            $this->error = array("login" => "Password is incorrect");
            return false;
        }
        
        //Generating the key that will be stored in the cookie or session
        $key = hash('sha256', microtime() + $username + "Pa602JnVdrgMnbvzkfmC");
        
        $sessionkey = hash('sha256', $ip . $key);
        
        //Adding the session to the database with a link to the user.
        $session = new Sessions();
        
        $session->setUserid((string)$user->getid());
        $session->setSessionkey($sessionkey);
        
        if(!($session->save()))
            return false;
        
        //If the user selected that he wishs to be remembered when logging it a cookie will be made and stored.
        if($remember == "on")
        {
            $cookie = new \Phalcon\Http\Cookie(
                    'Session_Key',
                    $key,
                    time()+60*60*24*6004,
                    '/',
                    'sharpframe.co.uk'
                    );
            if($cookie->send())
                ChromePhp::log ("Cookie sent");
            else
                ChromePhp::log ("Cookie Error");
        }
        
        //Creating a session by default even if a cookie is made.
        $session = new \Phalcon\Session\Bag('Session_Key');
        $session->Key = $key;
        
        return true;
    }
    
    function Logout($ip)
    {
        $cookieobj = new \Phalcon\Http\Cookie('Session_Key');
        $sessionobj = new \Phalcon\Session\Bag('Session_Key');

        if(isset($sessionobj))
        {
            $key = $sessionobj->Key;
            $sessionobj->destroy();
        }
        else if(isset($cookieobj))
        {
            $key = $cookieobj->getValue();
            $cookieobj->delete();
            ChromePhp::log("deleted");
        }
        else
            return false;
        
        $sessionkey = hash('sha256', $ip . $key);
        
        $session = Sessions::findFirst(array(
            array("sessionkey" => $sessionkey)
        ));
        
        //If the session was not found in the database then the database must of been cleaned and no need to continue
        if($session == null)
            return false;
        
        $session->delete();
        
        return true;
    }
    
    function Register($username, $passwordin, $email, $dob)
    {
        $user = new Users();
        $password = new Passwords();
        
        //Adding users details to the database
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
        
        //Adding password details to the database
        $password->setUserid((string)$user->getid());
        $password->setPassword($hashedpassword);
        $password->setSalt($salt);
        $password->setPasswordChange(microtime());
        $password->setLastLogin(microtime());
        
        if(!($password->save()))
            return false;
        
        return true;
    }
    
    function ResetPassword($userid, $newpassword)
    {
        $user = $this->GetUser($userid);
        
        if($user == false)
            return false;
            
       $user->setPassword($newpassword);
    }
    
    function ChangeEmail($userid, $email)
    {
        
    }
    
    static function Authenticate($ip)
    {
        //Creating pointers to the cookie and session classes
        $cookieobj = new \Phalcon\Http\Cookie('Session_Key');
        $sessionobj = new \Phalcon\Session\Bag('Session_Key');
        
        //Since a session will allways be created even with a cookie the session will be checked fist then the cookie. If the cookie returns true then a session will be created. If all else
        //fails then there is no cookie or session and the user is not logged in.
        if(isset($sessionobj))
            $key = $sessionobj->Key;
        else if(isset($cookieobj))
            $key = $cookieobj->getValue();
        else
            return null;
        
        //Hashing the ip and key that is stored in the cookie or session, if the users ip changes then the user will have to login again. 
        $sessionkey = hash('sha256', $ip . $key);
        
        $session = Sessions::findFirst(array(
            array("sessionkey" => $sessionkey)
        ));
        
        if($session == null)
        {
            ChromePhp::log ("Cant find session");
            return null;
        }
        
        $user = Users::findFirst(
            array("_id" => array("ObjectId" => $session->userid))
        );
        
        if($user == null)
        {
            ChromePhp::log("This did not work");
            return null;
        }
        
        return (string)$user->_id;
    }
    
    static function GetUser($userid)
    {
        ChromePhp::log($userid);
        
        $user = Users::findFirst(array(
            "_id" => array("ObjectId" => $userid)
         ));
        
        ChromePhp::log($user);
        
        if($user == null)
        {
            $this->error = array("GetUser" => "Userid is invalid");
            return false;
        }
        
        return $user;
    }
    
    function GetError()
    {
        return $this->error;
    }
}

?>
