<?php
class PhotoreportMain extends NewsIndexWidget
{
    public $type;
    public $maxButtonCount;
    public $categoryModel;
    public $photoreportModel;
    public $item_class="col-sm-2 col-md-2";
    
    public function init() {
//        $this->type='horizontal';
//        $this->maxButtonCount=6;
//
//        $this->blogModel=new Blog();
//        $this->blogModel->unsetAttributes();
        $this->photoreportModel=new Photoreport();
        $this->photoreportModel->unsetAttributes();

        $this->parent_category_code='photoreport';
        parent::init();
    }
    
    
    public function run()
    {
        $this->photoreportModel->setAttributes($this->blogModel->getAttributes());
        $photoreportModels=$this->photoreportModel->searchForCategory(6,false);

        $this->render('//main/photoreportMain', array('dataProvider'=>$photoreportModels));
    }
}
?>
