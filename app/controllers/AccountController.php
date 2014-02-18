<?php

class AccountController extends ControllerBase
{
    public function indexAction()
    {
        $this->view->title = "Account";
    }
    
    public function RegisterAction()
    {
        //Checking if there is already a vailid session if so redirect back to homepage
        if(Account::Authenticate($this->request->getClientAddress()) != 0)
        {
            $this->response->redirect("");
            $this->view->disable();
        }
        
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
        //Checking if there is already a vailid session if so redirect back to homepage
        if(Account::Authenticate($this->request->getClientAddress()) != 0)
        {
            $this->response->redirect("");
            $this->view->disable();
        }
        
        $this->view->title = "Login";
        
        //Checking if a post request was sent
        if ($this->request->isPost() == true)
        {
            
            $account = new Account();
            
            if($account->Login($this->request->getPost("username"), $this->request->getPost("password"), $this->request->getPost("remember"), $this->request->getClientAddress()))
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
