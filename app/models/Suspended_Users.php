<?php
class Suspended_Users extends \Phalcon\Mvc\Collection
{
    private $_Userid;
    private $Reason;
    private $StartDate;
    private $EndDate;
    
    public function initialize()
    {
        $this->useImplicitObjectIds(false);
    }
    
    public function setReason($reason)
    {
        //Converting it to UTF-8 to prevent errors with MongoDB
        $this->Reason = mb_convert_encoding($reason, "UTF-8", "ISO-8859-1");
    }
    
    public function getReason()
    {
        return $this->Reason;
    }
    
    public function setStartDate($datetime)
    {
        //Converting it to UTF-8 to prevent errors with MongoDB
        $this->StartDate = mb_convert_encoding($datetime, "UTF-8", "ISO-8859-1");
    }
    
    public function getStartDate()
    {
        return $this->StartDate;
    }
    
    public function setEndDate($datetime)
    {
        //Converting it to UTF-8 to prevent errors with MongoDB
        $this->EndDate = mb_convert_encoding($datetime, "UTF-8", "ISO-8859-1");
    }
    
    public function getEndDate()
    {
        return $this->EndDate;
    }
}

?>
