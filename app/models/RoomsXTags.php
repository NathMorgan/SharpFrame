<?php
class RoomsXTags extends \Phalcon\Mvc\Collection
{
    public $_id;
    public $Roomid;
    public $Tagid;
    
    public function initialize()
    {
        $this->useImplicitObjectIds(false);
    }
    
    public function setRoomid($roomid)
    {
        $this->Roomid = mb_convert_encoding($roomid, "UTF-8", "ISO-8859-1");
    }
    
    public function getRoomid()
    {
        return $this->Roomid;
    }
    
    public function setTagid($tagid)
    {
        $this->Tagid = mb_convert_encoding($tagid, "UTF-8", "ISO-8859-1");
    }
    
    public function getTagid()
    {
        return $this->Tagid;
    }
}

?>
