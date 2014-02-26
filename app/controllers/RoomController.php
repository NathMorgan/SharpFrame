<?php

class RoomController extends ControllerBase 
{
    public function indexAction()
    {
        
    }
    
    public function registerAction()
    {
        //Checking if there is already a vailid session if not redirect back to homepage
        if(Account::Authenticate($this->request->getClientAddress()) == null)
        {
            $this->response->redirect("");
            $this->view->disable();
        }
        
        if ($this->request->isPost() == true)
        {
            $room = new Room();
            if($room->Register($this->request->getPost("title"), $this->request->getPost("description"), $this->request->getPost("youtubeurl"), $_FILES['icon'], (string)ControllerBase::getUser()->_id))
            {
                $this->response->redirect("");
                $this->view->disable();
            }
        }
        
        $this->view->title = "New Room";
    }
    
    public function viewAction($roomid)
    {
        if(isset($roomid))
        {
            $room = new room();
            $roomdetails = $room->getRoom($roomid);
            $this->view->title = $roomdetails['name'];
        }
        $this->view->title = $roomid;
    }
}

?>
