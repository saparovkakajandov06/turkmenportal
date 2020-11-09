<?php

class CategoryListWidget extends CWidget
{
    public $count;
    public $category_code;
    public $parent_category_code;
    public $category_id;
    public $item_class;
    public $show_all=true;
    public $show_header;
    public $show_sub_header;
    public $categoryModel;
    public $is_tableview;
    public $is_only_listview;
    public $show_photo;

    public $parentCategoryModel;
    public $categyModel;
    public $categories;
    public $relatedActiveRecord;



    public function init() {

        $this->categoryModel=new Category();
        $this->categoryModel->unsetAttributes();
        $this->parentCategoryModel=$this->categoryModel->findParentCategoryByCode($this->parent_category_code);

        if(isset($this->parentCategoryModel)){
            $this->categories=$this->categoryModel->searchAnnouncements($this->parent_category_code);
//            $this->categories=$this->categoryModel->searchAnnouncements($this->parentCategoryModel->id);
        }

        if(isset($this->relatedActiveRecord)){
            $this->relatedActiveRecord=CActiveRecord::model($this->relatedActiveRecord);
        }


        parent::init();
    }


    public function run()
    {
//            $pagination_count=$this->count;
//            if($this->show_all==false)
//                $pagination_count=0;
//
//            $dataProvider=$this->catalogModel->searchForCategory($pagination_count);
//
//            if($dataProvider->totalItemCount>0 || isset($_GET['mini_search']))
                $this->render('CategoryListWidget');
    }
}
?>
