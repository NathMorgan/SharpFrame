<?php

class AccountController extends ControllerBase
{
    public function indexAction()
    {
        $this->view->title = "Account";
    }
    
    public function RegisterAction()
    {
        //Checking if the user is not logged in if so redirect back to homepage
        if($authenticated)
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
        //Checking if the user is not logged in if so redirect back to homepage
        if($authenticated)
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
        //Checking if the user is logged in if not redirect back to homepage
        if(!$authenticated)
        {
            $this->response->redirect("");
            $this->view->disable();
        }
        
        $this->view->title = "Logout";
        
        $account = new Account();
        
        $account->Logout($this->request->getClientAddress());
    }
    
    public function EditAction()
    {
        //Checking if the user is logged in if not redirect back to homepage
        if(!$authenticated)
        {
            $this->response->redirect("");
            $this->view->disable();
        }
        
         //Checking if a post request was sent
        if ($this->request->isPost() == true)
        {
        
        }
    }
    
    public function ForgotPasswordAction()
    {
        //Checking if the user is logged in if not redirect back to homepage
        if(!$authenticated)
        {
            $this->response->redirect("");
            $this->view->disable();
        }
        
         //Checking if a post request was sent
        if ($this->request->isPost() == true)
        {
            
        }
    }
}
