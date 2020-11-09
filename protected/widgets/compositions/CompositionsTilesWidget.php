<?php
class CompositionsTilesWidget extends CWidget
{
    public $count;
    public $category_code;
    public $category_id;
    public $item_class;
    public $show_all=true;
    public $is_truncate=true;
    public $categoryModel;
    public $maxPagerCount=8;
    
    
    public function init() {
        parent::init();
        if(!isset($this->count))
            $this->count=6;
        if(!isset($this->item_class))
            $this->item_class='col-md-4';
    }
    
    
    public function run()
    {
        $criteria=new CDbCriteria;
        $criteria->addCondition('length(title_'.Yii::app()->language.') > 0 ');
        $criteria->scopes=array('enabled','sort_newest');
        $criteria->limit=$this->count;
        $compositionsModels=Compositions::model()->findAll($criteria);

      
        $this->render('//tiles/CompositionsTilesWidget', array('compositionsModels'=>$compositionsModels,"item_class"=>$this->item_class));
    }
}
?>
