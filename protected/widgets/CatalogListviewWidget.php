<?php
class CatalogListviewWidget extends CWidget
{
    public $count;
    public $category_code;
    public $parent_category_code;
    public $category_id;
    public $item_class;
    public $show_all=true;
    public $show_header;
    public $show_sub_header;
    public $catalogModel;
    public $categoryModel;
    public $is_tableview;
    public $is_only_listview;
    public $show_photo;

    
    
    public function init() {
        $this->catalogModel=new Catalog();
        $this->catalogModel->unsetAttributes();

        
        if(isset ($this->category_id)){
            $this->categoryModel = Category::model()->findByPk($this->category_id);
            $this->catalogModel->category_id=$this->category_id;
        }elseif(isset ($this->category_code)){
            $this->categoryModel = Category::model()->no_parent()->findByAttributes(array('code'=>$this->category_code));
            $this->catalogModel->category_id=$this->categoryModel->id;

        }
        
        
        if(!isset ($this->show_header))
            $this->show_header=false;
        
        if(!isset ($this->is_tableview))
            $this->is_tableview=false;
        
        if(!isset ($this->is_only_listview))
            $this->is_only_listview=false;
        
        if(!isset ($this->show_sub_header))
            $this->show_sub_header=false;
                
//        $this->catalogModel->category_code=$this->category_code;
        
        parent::init();
    }
    
    
    public function run()
    {
        
//        if(isset ($this->category_id)){
            $pagination_count=$this->count;
            if($this->show_all==false)
                $pagination_count=0;    
        

            if (isset($_GET['mini_search'])){
                $this->catalogModel->mini_search=$_GET['mini_search'];
            }

            $dataProvider=$this->catalogModel->searchForCategory($pagination_count);
            if($dataProvider->totalItemCount>0 || isset($_GET['mini_search']))
                $this->render('CatalogListviewWidget', array('dataProvider'=>$dataProvider,'categoryModel'=>$this->categoryModel));
//        }
        
//        if(isset ($categoryModel)){
//            $dataProvider=Catalog::model()->searchCategoryForIndex($categoryModel->id);
//            $this->render('CatalogListviewWidget', array('dataProvider'=>$dataProvider,'categoryModel'=>$categoryModel));
//        }
    }
}
?>
