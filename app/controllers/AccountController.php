<?php

class AccountController extends ControllerBase
{
    public function indexAction()
    {
        
    }
    
    public function RegisterAction()
    {
        $this->view->title = "Register";
        
        //Checking if a post request was sent
        if ($this->request->isPost() == true) {
            
            $account = new Account();
            
            if($account->Register($this->request->getPost("username"), $this->request->getPost("password"), $this->request->getPost("email"), time()))
                $this->view->title = "worked";
            else
                $this->view->title = "failed";
            
        }
    }
    
    public function LoginAction()
    {
        $this->view->title = "Login";
    }
    
    public function LogoutAction()
    {
        
    }
    
    public function EditAction()
    {
        
    }
    
    public function ForgotPasswordAction()
    {
        
    }
}
