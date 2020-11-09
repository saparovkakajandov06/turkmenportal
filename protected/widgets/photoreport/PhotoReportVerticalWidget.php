<?php
class PhotoReportVerticalWidget extends CWidget
{
    public $type;
    public $maxButtonCount;
    public $item_class;
    public $count;


    public function init() {
        $this->type='horizontal';
        $this->count=4;
        parent::init();
    }
    
    
    public function run()
    {

        $criteria=new CDbCriteria();
        $criteria->scopes=array('sort_newest','sort_by_order','enabled');
        $criteria->limit=$this->count;
//        $criteria->compare('title_tm1', "a",true);

        $photoreportModels=Photoreport::model()->findAll($criteria);
//        $dataProvider=Blog::model()->searchCategoryForIndex(338);
        $this->render('PhotoReportVerticalWidget', array('dataProvider'=>$photoreportModels));
    }
}
?>
