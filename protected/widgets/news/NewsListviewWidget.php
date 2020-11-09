<?php
class NewsListviewWidget extends CWidget
{
    public $count;
    public $category_code;
    public $category_id;
    public $item_class;
    public $show_all=true;
    public $is_truncate=true;
    public $categoryModel;
    public $maxPagerCount=8;
    public $blogModel;
    public $itemView;
    public $headerText;
    public $headerCssClass;
    
    
    public function init() {
        parent::init();
        if(!isset($this->item_class))
            $this->item_class='col-md-4';
        if(!isset($this->count))
            $this->count=10;
        if(!isset($this->itemView))
            $this->itemView='/_views/_tilesview';
        
        $this->blogModel=new Blog();
        $this->blogModel->unsetAttributes();
        
        if(isset ($this->category_id)){
            $this->blogModel->category_id=$this->category_id;
        }
        if(isset ($this->category_code)){
            $this->blogModel->category_code=$this->category_code;
        }
        
        if(isset ($this->parent_category_id)){
            $this->blogModel->parent_category_id=$this->parent_category_id;
        }
        
        if(isset ($this->parent_category_code)){
            $this->blogModel->parent_category_code=$this->parent_category_code;
        }
    }
    
    
    public function run()
    {
        $dataProvider=$this->blogModel->searchForCategory(null,$this->count);
        if($dataProvider->totalItemCount>0)
            $this->render('NewsListviewWidget', array('dataProvider'=>$dataProvider));
    }
}
?>
