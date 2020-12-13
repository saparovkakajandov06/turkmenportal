<?php

class NewsIndexWidget extends CWidget {
    public $count;
    public $category_code;
    public $category_id;
    public $parent_category_id;
    public $parent_category_code;
    public $item_class;
    public $show_all = true;
    public $is_truncate = true;
    public $categoryModel;
    public $blogModel;
    public $maxPagerCount = 8;


    public function init() {
        $this->blogModel = new Blog();
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


        $sportCategoryModel = Category::model()->findByAttributes(array ('code' => 'news.sport'));
        if (isset($sportCategoryModel)) {
            $this->blogModel->categoryid_except = array ($sportCategoryModel->id);
        }


        parent::init();
    }


    public function run() {

        $blogModels = $this->blogModel->searchForCategory($this->count, true);
        $mainBlogModel = null;

        foreach ($blogModels as $key => $blog) {
            if ($blog->is_main == 1) {
                $mainBlogModel = $blog;
                $blogModels = array_splice($blogModels, $key, 1);
                break;
            }
        }
        if (!isset($mainBlogModel)) {
            $mainBlogModel = $blogModels[0];
            $blogModels = array_splice($blogModels, 1);
        }


        $newestBlogModels = $blogModels;
//        $newestBlogModels=  array_splice($blogModels,1);
//        $bottomBlogModels=  array_splice($newestBlogModels,-4);

        if (isset($mainBlogModel))
            $this->render('NewsIndexWidget', array ('mainBlogModel' => $mainBlogModel, 'newestBlogModels' => $newestBlogModels));
    }
}

?>
