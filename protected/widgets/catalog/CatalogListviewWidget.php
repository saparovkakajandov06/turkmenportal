<?php
class CatalogListviewWidget extends CWidget
{
    public $count;
    public $category_code;
    public $parent_category_code;
    public $category_id;
    public $parent_category_id;
    public $item_class;
    public $show_all=true;
    public $show_header=false;
    public $show_sub_header=false;
    public $catalogModel;
    public $categoryModel;
    public $is_tableview=false;
    public $is_only_listview=false;
    public $show_photo;
    public $itemView="_listview";
    public $view = "CatalogListviewWidget";

    public $sortableAttributes=array(
                    'date_added',
                    'views',
    );
    
    
    
    
    public function init() {
        $this->catalogModel=new Catalog();
        $this->catalogModel->unsetAttributes();


        parent::init();
    }
    
    
    
    
    public function run()
    {

        if(isset ($this->category_id)){
            $this->categoryModel=Category::model()->findByPk($this->category_id);
            $this->catalogModel->category_id=$this->category_id;
        }
        if(isset ($this->category_code)){
            $this->categoryModel=Category::model()->findByAttributes(array('code'=>$this->category_code));
            if(isset($this->categoryModel))
                $this->catalogModel->category_id=$this->categoryModel->id;
        }

        if(isset ($this->parent_category_id)){
            $this->categoryModel=Category::model()->findByPk($this->parent_category_id);
            if(isset($this->categoryModel))
                $this->catalogModel->parent_category_id=$this->categoryModel->id;
        }

        if(isset ($this->parent_category_code)){
            $this->catalogModel->parent_category_code=$this->parent_category_code;
            $this->categoryModel=Category::model()->findParentCategoryByCode($this->parent_category_code);
//            if(isset($this->categoryModel))
//                $this->catalogModel->parent_category_id=$this->categoryModel->id;
        }
        
        $pagination_count=$this->count;
        if($this->show_all==false)
            $pagination_count=0;


        if (isset($_GET['mini_search'])){
            $this->catalogModel->mini_search=$_GET['mini_search'];
        }


        $dataProvider=$this->catalogModel->searchForCategory($pagination_count);
        if($dataProvider->totalItemCount>0 || isset($_GET['mini_search']))
            $this->render($this->view, array('dataProvider'=>$dataProvider,'categoryModel'=>$this->categoryModel));
    }
}
?>
