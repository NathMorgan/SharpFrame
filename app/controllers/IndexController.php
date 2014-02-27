<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $room = new Room();
        
        $this->view->title = "Home";
        $this->view->rooms = $room->getRooms();
    }

}

