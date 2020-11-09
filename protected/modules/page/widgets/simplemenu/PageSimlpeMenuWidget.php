<?php
class PageSimlpeMenuWidget extends CWidget
{
    public $count;
    public $code;
    public $parent_code;
    public $item_class;
    public $pageModel;
    public $show_photo;
    public $itemView="_listview";

    
    
    
    public function init() {
        $this->pageModel=new Page();
        $this->pageModel->unsetAttributes();
        parent::init();
    }
    
    
    
    
    public function run()
    {
            $criteria=new CDbCriteria();
            $criteria->scopes=array("enabled");
            $criteria->compare('code', $this->code);
            
            if(isset($this->parent_code)){
                $criteria->with=array("parent"=>array('select'=>'code'));
                $criteria->compare('parent.code', $this->parent_code);
            }

            $dataProvider= new CActiveDataProvider($this->pageModel, 
                array(
                    'criteria'=>$criteria,
                    'pagination' => false
              ));

            
            if($dataProvider->totalItemCount>0)
                $this->render('PageSimlpeMenuWidget', array('dataProvider'=>$dataProvider));
    }
}
?>
