<?php
class AfishaWidget extends CWidget
{
    public $count;
    public $category_code;
    public $category_id;
    public $item_class;
    public $show_all=true;
    public $randomLast = false;
    
    
    public function init() {
        if(!isset ($this->category_code))
            $this->category_code='billboard';
        parent::init();
    }
    
    
    
    public function run()
    {
         $pagination_count=$this->count;
        if($this->show_all==false)
            $pagination_count=0;   
        
        $catalogModel=new Catalog();
        $catalogModel->unsetAttributes();
        
        if(isset ($this->category_id)){
            $catalogModel->category_id=$this->category_id;
        }elseif(isset ($this->category_code)){
            $categoryModel = Category::model()->no_parent()->findByAttributes(array('code'=>$this->category_code));
            $catalogModel->parent_category_id=$categoryModel->id;
        }

        if ($this->randomLast){
            $pagination_count= $this->randomLast;
        }

            $afishaModels=$catalogModel->searchForCategory($pagination_count,true);
            if (count($afishaModels)>0 && $this->randomLast){
                $afishaModels[] = $afishaModels[rand(0,$this->randomLast-1)];
            }
//            var_dump(count($afishaModels));die;
            if(count($afishaModels)>0)
                $this->render('AfishaWidget', array('afishas'=>$afishaModels ));
//            $afishaModels=Catalog::model()->searchForCategoryByCode($this->category_code, $this->count,true);
//            if(count($afishaModels)>0)
//                $this->render('AfishaIndexWidget', array('afishas'=>$afishaModels));
    }
    
    
}
?>