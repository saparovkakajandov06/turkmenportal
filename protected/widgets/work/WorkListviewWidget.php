<?php
class WorkListviewWidget extends CWidget
{
    public $count;
    public $category_code;
    public $parent_category_code;
    public $category_id;
    public $item_class;
    public $show_all=true;
    public $show_header;
    public $show_sub_header;
    public $workModel;
    public $categoryModel;
    public $is_tableview;
    public $is_only_listview;
    public $show_photo;

    
    
    public function init() {
        $this->workModel=new Work();
        $this->workModel->unsetAttributes();
//        $this->autoModel->category_id=$this->category_id;
//        $this->autoModel->category_code=$this->category_code;
//        $this->autoModel->parent_category_code=$this->parent_category_code;
//        
//        if(isset ($this->category_id))
//            $this->categoryModel = Category::model()->findByPk($this->category_id);
//        elseif(isset ($this->category_code))
//            $this->categoryModel = Category::model()->no_parent()->findByAttributes(array('code'=>$this->category_code));
//
//        if(!isset ($this->show_header))
//            $this->show_header=false;
//        
//        if(!isset ($this->is_tableview))
//            $this->is_tableview=false;
//        
//        if(!isset ($this->is_only_listview))
//            $this->is_only_listview=false;
//        
//        if(!isset ($this->show_sub_header))
//            $this->show_sub_header=false;
                
        parent::init();
    }
    
    
    public function run()
    {
            $pagination_count=$this->count;
            if($this->show_all==false)
                $pagination_count=0;    
        
            if (isset($_GET['mini_search'])){
                $this->catalogModel->mini_search=$_GET['mini_search'];
            }

            $dataProvider=$this->workModel->searchForIndex($pagination_count);
            if($dataProvider->totalItemCount>0 || isset($_GET['mini_search']))
                $this->render('WorkListviewWidget', array('dataProvider'=>$dataProvider));
    }
}
?>
