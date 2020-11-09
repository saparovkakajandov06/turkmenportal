<?php

class AfishaIndexWidget extends CWidget {
    public $count;
    public $category_code;
    public $category_id;
    public $item_class;
    public $show_all = true;


    public function init() {
        if (!isset ($this->category_code))
            $this->category_code = 'billboard';

        $this->publishAssets();
        parent::init();
    }


    public function run() {
        if (!isset($this->count))
            $this->count = 10;

        $pagination_count = $this->count;
        if ($this->show_all == false)
            $pagination_count = 0;


        $catalogModel = new Catalog();
        $catalogModel->unsetAttributes();

        if (isset ($this->category_id)) {
            $catalogModel->category_id = $this->category_id;
        } elseif (isset ($this->category_code)) {
            $categoryModel = Category::model()->no_parent()->findByAttributes(array ('code' => $this->category_code));
            $catalogModel->parent_category_id = $categoryModel->id;
        }

        $afishaModels = $catalogModel->searchForCategory($pagination_count, true);
        if (count($afishaModels) > 0)
            $this->render('AfishaIndexWidget', array ('afishas' => $afishaModels));
    }


    public function publishAssets() {
        $assets = dirname(__FILE__) . '/assets';
        $baseUrl = Yii::app()->assetManager->publish($assets, false, -1, YII_DEBUG);
        if (is_dir($assets)) {
            //@ALEXTODO make ui interface optional
            Yii::app()->clientScript->registerCssFile($baseUrl . '/owl.carousel.css');
            Yii::app()->clientScript->registerCssFile($baseUrl . '/owl-theme.css');
            //The Templates plugin is included to render the upload/download listings
            Yii::app()->clientScript->registerScriptFile($baseUrl . '/owl.carousel.min.js?v=1.01', CClientScript::POS_END);
//            Yii::app()->clientScript->registerScriptFile($baseUrl . '/js/init.js', CClientScript::POS_READY);
        } else {
            throw new CHttpException(500, __CLASS__ . ' - Error: Couldn\'t find assets to publish.');
        }
    }


}

?>