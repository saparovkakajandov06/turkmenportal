<?php
class CalendarWidget extends CWidget
{
    public $url;

    public function init() {
        if(!isset($this->url))
            $this->url="blog/index";

        parent::init();
    }
    
    
    public function run()
    {
        $this->render('//calendar/CalendarWidget', array('url'=>$this->url));
    }
}
?>
