<?php
class NewsListWidget extends CWidget
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

        if (isset ($this->category_id)) {
            $this->categoryModel = Category::model()->findByPk($this->category_id);
            $this->blogModel->category_id = $this->category_id;
        }
        if (isset ($this->category_code)) {
            $this->categoryModel = Category::model()->findByAttributes(array ('code' => $this->category_code));
            if (isset($this->categoryModel))
                $this->blogModel->category_id = $this->categoryModel->id;
        }

        if (isset ($this->parent_category_id)) {
            $this->categoryModel = Category::model()->findByPk($this->parent_category_id);
            if (isset($this->categoryModel))
                $this->blogModel->parent_category_id = $this->categoryModel->id;
        }

        if (isset ($this->parent_category_code)) {
            $this->categoryModel = Category::model()->findParentCategoryByCode($this->parent_category_code);
            if (isset($this->categoryModel))
                $this->blogModel->parent_category_id = $this->categoryModel->id;
        }
    }
    
    
    public function run()
    {
        $dataProvider=$this->blogModel->searchForCategory($this->count);
        if($dataProvider->totalItemCount>0)
            $this->render('NewsListWidget', array('dataProvider'=>$dataProvider));
    }
}
?>
