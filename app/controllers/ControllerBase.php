<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    public $session;
    public $authenticated;
    public $user;
    
    public function initialize()
    {
        
        $userid = Account::Authenticate($this->request->getClientAddress());
        
         if($userid != null)
         {
             $this->authenticated = true;
             $this->user = Account::GetUser($userid);
             $this->view->username = ucfirst($this->user->username);
         }
         else
         {
             $this->authenticated = false;
             $this->view->username = "Guest";
         }
    }
    
    public function getUser()
    {
        return $this->user;
    }
    
    public function getAuthenticated()
    {
        return $this->authenticated;
    }
}