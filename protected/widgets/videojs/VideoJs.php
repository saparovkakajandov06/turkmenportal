<?php

class VideoJs extends CWidget
{
    public $document;
    public $width;
    public $height;
    public $innerWidth;
    public $innerHeight;
    public $item_class;


    public function init()
    {
        if (!isset($this->width))
            $this->width = 400;

        if (!isset($this->height)) {
            $this->height = $this->width * 9 / 16;
        }

        $this->publishAssets();
        parent::init();
    }

    public function publishAssets()
    {
        $assets = dirname(__FILE__) . '/assets';
        $baseUrl = Yii::app()->assetManager->publish($assets, false, -1, YII_DEBUG);
        if (is_dir($assets)) {
//            Yii::app()->clientScript->registerCssFile('https://vjs.zencdn.net/5.11.7/video-js.css?v=1.23');
//            Yii::app()->clientScript->registerCssFile($baseUrl . '/css/custom.css?v=1.33');
//            Yii::app()->clientScript->registerScriptFile('https://vjs.zencdn.net/5.11.7/video.js', CClientScript::POS_END);
//            Yii::app()->clientScript->registerScriptFile('https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-hls/3.6.0/videojs-contrib-hls.js?v=1.01', CClientScript::POS_END);
//            Yii::app()->clientScript->registerScriptFile('https://rawgit.com/kmoskwiak/videojs-resolution-switcher/dev/lib/videojs-resolution-switcher.js', CClientScript::POS_END);


            Yii::app()->clientScript->registerCssFile($baseUrl . '/css/video-js.min.css?v=1.26');
//            Yii::app()->clientScript->registerCssFile('https://m.horjun.tv/videohls/css/vsg-skin.css');
            Yii::app()->clientScript->registerCssFile($baseUrl . '/css/custom.css?v=1.37');
            Yii::app()->clientScript->registerScriptFile($baseUrl . '/js/video.min.js?v=1.02', CClientScript::POS_END);
            Yii::app()->clientScript->registerScriptFile($baseUrl . '/js/videojs-contrib-quality-levels.js?v=1.51', CClientScript::POS_END);
            Yii::app()->clientScript->registerScriptFile($baseUrl . '/js/videojs-hls-quality-selector.min.js?v=1.02', CClientScript::POS_END);
            Yii::app()->clientScript->registerScriptFile($baseUrl . '/js/videojs.hotkeys.min.js?v=1.02', CClientScript::POS_END);

        } else {
            throw new CHttpException(500, __CLASS__ . ' - Error: Couldn\'t find assets to publish.');
        }
    }

    public function run()
    {
        if (isset($this->document))
            $this->render('VideoJs');
    }
}

?>