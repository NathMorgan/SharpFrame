<?php

class RoomController extends ControllerBase 
{
    public function indexAction()
    {
        
    }
    
    public function registerAction()
    {
        $this->view->title = "New Room";
        if ($this->request->isPost() == true)
        {
            $room = new Room();
            $room->Register();
        }
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
