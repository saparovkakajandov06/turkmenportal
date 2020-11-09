<?php

class PhotoSwipe extends CWidget {

    /**
     * the url to the upload handler
     * @var string
     */
    public $url;
    public $maxNumberOfFiles;
    public $showResultTable=true;
    public $showGlobalProgressBar=true;

    /**
     * set to true to use multiple file upload
     * @var boolean
     */
    public $multiple = false;

    /**
     * The upload template id to display files available for upload
     * defaults to null, meaning using the built-in template
     */
    public $uploadTemplate;

    /**
     * The template id to display files available for download
     * defaults to null, meaning using the built-in template
     */
    public $downloadTemplate;

    /**
     * Wheter or not to preview image files before upload
     */
    public $previewImages = true;

    /**
     * Wheter or not to add the image processing pluing
     */
    public $imageProcessing = true;

    /**
     * set to true to auto Uploading Files
     * @var boolean
     */
    public $autoUpload = false;
    /**
     * @var bool whether form tag should be used at widget
     */
    public $showForm = true;
    public $prependFiles = false;

    
    public $galleryView = 'gallery';
    public $wrapperView = 'wrapper';
    public $model;
    public $photos;

    
    
    public function init() {
        
        
        parent::init();
        $this -> publishAssets();
    }

    /**
     * Generates the required HTML and Javascript
     */
    public function run() {

//        $this -> render($this->wrapperView);
        $this -> render($this->galleryView, array());

    }

    /**
     * Publises and registers the required CSS and Javascript
     * @throws CHttpException if the assets folder was not found
     */
    public function publishAssets() {
        $assets = dirname(__FILE__) . '/assets';
        $baseUrl = Yii::app() -> assetManager -> publish($assets);
        if (is_dir($assets)) {
            Yii::app() -> clientScript -> registerCssFile($baseUrl . '/photoswipe.css');
            Yii::app() -> clientScript -> registerCssFile($baseUrl . '/gallery-design.css?v=1.5');
            Yii::app() -> clientScript -> registerCssFile($baseUrl . '/default-skin/default-skin.css');
            Yii::app() -> clientScript -> registerScriptFile($baseUrl . '/photoswipe-ui-default.min.js', CClientScript::POS_END);
            Yii::app() -> clientScript -> registerScriptFile($baseUrl . '/photoswipe.js', CClientScript::POS_END);
            Yii::app() -> clientScript -> registerScriptFile($baseUrl . '/settings.js', CClientScript::POS_END);
        } else {
            throw new CHttpException(500, __CLASS__ . ' - Error: Couldn\'t find assets to publish.');
        }
    }

    
    protected function t($message, $params=array ( ))
    {
        return Yii::t('xupload.widget', $message, $params);
    }

}
