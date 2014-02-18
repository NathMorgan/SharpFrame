<?php

class AccountController extends ControllerBase
{
    public function indexAction()
    {
        $this->view->title = "Account";
    }
    
    public function RegisterAction()
    {
        $this->view->title = "Register";
        
        //Checking if a post request was sent
        if ($this->request->isPost() == true)
        {
            
            $account = new Account();
            
            if($account->Register($this->request->getPost("username"), $this->request->getPost("password"), $this->request->getPost("email"), $this->request->getPost("dob")))
            {
                $this->response->redirect("");
                $this->view->disable();
            }
            else
            {
                $this->view->title = "failed";
            }
            
        }
    }
    
    public function LoginAction()
    {
        $this->view->title = "Login";
        
        //Checking if a post request was sent
        if ($this->request->isPost() == true)
        {
            
            $account = new Account();
            
            if($account->Login($this->request->getPost("username"), $this->request->getPost("password"), $this->request->getPost("remember"), $this->request->getClientAddress()))
            {
                $this->view->title = "worked";
            }
            else
            {
                $this->view->title = "failed";
            }
            
        }
    }
    
    public function LogoutAction()
    {
        
    }
    
    public function EditAction()
    {
         //Checking if a post request was sent
        if ($this->request->isPost() == true)
        {
        
        }
    }
    
    public function ForgotPasswordAction()
    {
         //Checking if a post request was sent
        if ($this->request->isPost() == true)
        {
            
        }
    }
}
