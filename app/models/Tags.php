<?php
class Tags extends \Phalcon\Mvc\Collection
{
    private $_id;
    private $Tag;
    
    public function initialize()
    {
        $this->useImplicitObjectIds(false);
    }
    
    public function setTag($tag)
    {
        $this->Tag = mb_convert_encoding($tag, "UTF-8", "ISO-8859-1");
    }
    
    public function getTag()
    {
        return $this->Tag;
    }
}

?>
