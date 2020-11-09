<?php

class NewsTilesWidget extends CWidget {
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

    public $show_image=true;
    public $show_title=true;
    public $show_description=true;

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

        parent::init();
    }


    public function run() {

        $dataProvider = $this->blogModel->searchForCategory($this->count);
//        echo "<pre>";
//        print_r($dataProvider->totalItemCount);
//        echo "</pre>";
//        exit(1);
        if ($dataProvider->totalItemCount > 0)
            $this->render('NewsTilesWidget', array ('dataProvider' => $dataProvider));
    }
}

?>
