<?php

class OpenWeather extends CWidget {

    public $view="_view";
    public $cssClass=".weather-wrapper";
    public $iconTarget=".weather-icon";
    public $key="f01088043b6c77053fe39ce496432989";
    public $lang="ru";
    public $customIcons;
    public $city ='Ashgabat, TM';
    public $descriptionTarget=".weather-description";
    public $windSpeedTarget;
    public $minTemperatureTarget;
    public $maxTemperatureTarget;
    public $humidityTarget;
    public $sunriseTarget;
    public $sunsetTarget;
    public $placeTarget=".weather-place";
    
    public $options=array();
    public $json_options;
    


    public function init() {
        
        
        parent::init();
        $this -> publishAssets();
    }

    /**
     * Generates the required HTML and Javascript
     */
    public function run() {
        
       
        
//        $this->options['key'] = $this->key;
//        $this->options['autoUpload'] = $this -> autoUpload;
//
        if (!$this->customIcons) {
            $assets = dirname(__FILE__) . '/assets';
            $baseUrl = Yii::app() -> assetManager -> publish($assets);
            $this->options['customIcons'] = $baseUrl.'/img/icons/weather/';
        }
        if ($this->city) {
            $this->options['city'] = $this->city;
        }
        if ($this->lang) {
            $this->options['lang'] = $this->lang;
        }
        if ($this->descriptionTarget) {
            $this->options['descriptionTarget'] = $this->descriptionTarget;
        }
        if ($this->sunriseTarget) {
            $this->options['sunriseTarget'] = $this->sunriseTarget;
        }
        if ($this->sunsetTarget) {
            $this->options['sunsetTarget'] = $this->sunsetTarget;
        }
        if ($this->placeTarget) {
            $this->options['placeTarget'] = $this->placeTarget;
        }
        if ($this->cssClass) {
            $this->options['cssClass'] = $this->cssClass;
        }
        if ($this->iconTarget) {
            $this->options['iconTarget'] = $this->iconTarget;
        }
        if ($this->key) {
            $this->options['key'] = $this->key;
        }
        
        
        $this->json_options = CJavaScript::encode($this ->options);
//        echo "<pre>";
//        print_r($this->json_options);
//        echo "</pre>";
        $this -> render($this->view, array());

    }

    /**
     * Publises and registers the required CSS and Javascript
     * @throws CHttpException if the assets folder was not found
     */
    public function publishAssets() {
        $assets = dirname(__FILE__) . '/assets';
        $baseUrl = Yii::app() -> assetManager -> publish($assets);
        if (is_dir($assets)) {
            Yii::app() -> clientScript -> registerCssFile($baseUrl . '/css/style.css');
            Yii::app() -> clientScript -> registerScriptFile($baseUrl . '/openWeather.js', CClientScript::POS_END);
        } else {
            throw new CHttpException(500, __CLASS__ . ' - Error: Couldn\'t find assets to publish.');
        }
    }

    
    protected function t($message, $params=array ( ))
    {
        return Yii::t('openweather.widget', $message, $params);
    }

}
