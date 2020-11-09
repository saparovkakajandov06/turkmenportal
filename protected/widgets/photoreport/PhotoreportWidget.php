<?php

class PhotoreportWidget extends NewsIndexWidget
{
    public $type;
    public $count;
    public $item_count;
    public $item_class;
    public $wrapper_class;
    public $itemView;
    public $nextLink;
    public $nextLinkCss;
    public $photoreportModel;
    public $settings = array();


    public function init()
    {
        $this->type = 'horizontal';

        if (!isset($this->count))
            $this->count = count($this->settings);

        if (!isset($this->itemView))
            $this->itemView = 'default';
        if (!isset($this->item_count))
            $this->item_count = 4;

        if (!isset($this->nextLinkCss))
            $this->nextLinkCss = 'col-sm-12 ';


        $this->photoreportModel = new Photoreport();
        $this->photoreportModel->unsetAttributes();

        $this->parent_category_code = 'photoreport';

        $this->publishAssets();
        parent::init();
    }

    public function publishAssets()
    {
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


    public function run()
    {
//        $criteria=new CDbCriteria();
//        $criteria->scopes=array('sort_newest','sort_by_order','enabled');
//        $criteria->limit=$this->count;

        $this->photoreportModel->setAttributes($this->blogModel->getAttributes(), false);
        $photoreportModels = $this->photoreportModel->searchForCategory($this->count, true);


        $this->render("//photoreport/" . $this->itemView, array('photoreportModels' => $photoreportModels));
    }
}

?>
