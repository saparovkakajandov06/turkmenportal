<?php
class BlogListviewWidget extends CWidget
{
    public $count;
    public $category_code;
    public $parent_category_code;
    public $category_id;
    public $parent_category_id;
    public $item_class;
    public $show_all=true;
    public $is_truncate=true;
    public $blogModel;
    public $categoryModel;
    public $maxPagerCount=5;
    
    
    public function init() {
        $this->blogModel=new Blog();
        $this->blogModel->unsetAttributes();
        
        if(isset ($this->category_id)){
//            $this->categoryModel = Category::model()->findByPk($this->category_id);
            $this->blogModel->category_id=$this->category_id;
        }
        if(isset ($this->category_code)){
//            $this->categoryModel = Category::model()->no_parent()->findByAttributes(array('code'=>$this->category_code));
            $this->blogModel->category_code=$this->category_code;
        }
        
        if(isset ($this->parent_category_id)){
            $this->blogModel->parent_category_id=$this->parent_category_id;
        }
        
        if(isset ($this->parent_category_code)){
            $this->blogModel->parent_category_code=$this->parent_category_code;
        }
        
        
        parent::init();
    }
    
    
    public function run()
    {
//        if(isset ($this->category_id)){
////            if(isset ($this->category_id))
////                $this->categoryModel = Category::model()->findByPk($this->category_id);
//            $pagination_count=$this->count;
//            if($this->show_all==false)
//                $pagination_count=0;    
//            $dataProvider=Blog::model()->searchForCategory($this->category_id, $pagination_count);
//            if($dataProvider->totalItemCount>0)
//                $this->render('BlogListviewWidget', array('dataProvider'=>$dataProvider));
//        }elseif(isset ($this->category_code)){
//            $this->categoryModel = Category::model()->no_parent()->findByAttributes(array('code'=>$this->category_code));
//            $dataProvider=Blog::model()->searchForCategoryByCode($this->category_code, $this->count);
//            if($dataProvider->totalItemCount>0)
//                $this->render('BlogListviewWidget', array('dataProvider'=>$dataProvider));
//        }else{
//            $this->categoryModel = Category::model()->no_parent()->findByAttributes(array('code'=>'news'));
//            $dataProvider=Blog::model()->searchForCategoryByCode(null, $this->count);
//            if($dataProvider->totalItemCount>0)
//                $this->render('BlogListviewWidget', array('dataProvider'=>$dataProvider));
//        }
        
         
        $dataProvider=$this->blogModel->searchForCategory($pagination_count);
        if($dataProvider->totalItemCount>0 || isset($_GET['mini_search']))
            $this->render('BlogListviewWidget', array('dataProvider'=>$dataProvider,'categoryModel'=>$this->categoryModel));
    }
}
?>
