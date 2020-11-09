<?php
class AutoFilterForm extends CWidget
{
    public $new_count;
    public $old_count;
    public $show_header;
    public $autoModel;
    public $show_photo;
    public $route="";

    
    
    public function init() {
        $this->autoModel=new Auto();
        $this->autoModel->unsetAttributes();

        $autoCategory=Category::model()->findParentCategoryByCode('auto');
        if(isset($autoCategory))
            $this->route=$autoCategory->getUrl();

        $criteria=new CDbCriteria();
        $criteria->addNotInCondition('auto_condition',array(Auto::AUTO_CONDITION_NEW));
        $criteria->addCondition('auto_condition is null','OR');
        $criteria->compare('status',Auto::STATUS_ENABLED);
        $this->old_count=Auto::model()->count($criteria);


        $this->new_count=Auto::model()->countByAttributes(array('auto_condition'=>Auto::AUTO_CONDITION_NEW,'status'=>Auto::STATUS_ENABLED));

        parent::init();
    }
    
    
    public function run()
    {
        $this->render('//autoFilter/AutoFilterForm', array('model'=>$this->autoModel));
    }
}
?>
