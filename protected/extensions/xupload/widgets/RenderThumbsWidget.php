<?php

class RenderThumbsWidget extends CWidget
{
    public $docs=array();
    public $view;
    
    public function init() {
        if(!isset($this->view))
            $this->view="download_for_client";
        parent::init();
    }
    
    
    
    
    public function run()
    {
//        if(isset($this->docs) && count($this->docs)>0 )
        $this->render($this->view, array());
    }
}
?>
