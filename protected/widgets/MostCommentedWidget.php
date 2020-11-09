<?php
class MostCommentedWidget extends CWidget
{
    public $count;
    public $item_class;
    public $show_all;
  
    
    
    public function init() {
        parent::init();
    }
    
    
    public function run()
    {
        $commentModel = new Comments();
        $commentModel->unsetAttributes();
        $dataProvider=$commentModel->searchForMostCommented($this->count);
        if($dataProvider->totalItemCount>0)
            $this->render('MostCommentedWidget', array('dataProvider'=>$dataProvider));
    }
}
?>
