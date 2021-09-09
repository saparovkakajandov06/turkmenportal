<?php

class CategoryLinkWidget extends CWidget {
    public $maxSubCatCount;
    public $category_id;
    public $category_code;
    public $categoy_index_url;
    public $cssClass;
    public $override_main_title;
    public $view  = 'CategoryLinkWidget';


    public function init() {
        parent::init();
    }


    public function run() {
        $sub_categories = array ();
        $categoryModel = null;

        $criteria = new CDbCriteria();
        $criteria->compare('t.code', $this->category_code, false);

        $criteria->scopes = array ('enabled', 'sort_by_sort_order');
        $categoryModels = Category::model()->cache(Yii::app()->params['cache_duration'], new CTagCacheDependency('Category'))->sort_by_sort_order()->findAll($criteria);

        foreach ($categoryModels as $cat) {
            if ($cat->parent_id == null && $cat->status == 1)
                $categoryModel = $cat;
            else if ($cat->status == 1) {
                $sub_categories[] = $cat;
            }
        }

        if (!isset($categoryModel))
            $categoryModel = array_shift($sub_categories);

        if (isset ($categoryModel)) {
            $this->render($this->view, array ('sub_categories' => $sub_categories, 'categoryModel' => $categoryModel));
        }
    }

}

?>
