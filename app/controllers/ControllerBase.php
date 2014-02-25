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
             $authenticated = true;
             $user = Account::GetUser($userid);
             $this->view->username = ucfirst($user->username);
         }
         else
         {
             $authenticated = false;
             $this->view->username = "Guest";
         }
    }
}