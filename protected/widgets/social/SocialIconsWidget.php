<?php

class SocialIconsWidget extends CWidget
{
    public $social_links;

    public function init()
    {
        if (!isset($this->social_links)) {
            $this->social_links = array(
                'facebook' => 'https://www.facebook.com/tphabar',
                'twitter' => 'https://twitter.com/turkmenportal',
                'linkedin' => 'https://www.linkedin.com/company/turkmenportal',
                'instagram' => 'https://www.instagram.com/turkmenportal',
                'vkontakte' => 'https://vk.com/turkmenportal',
                'youtube' => 'https://www.youtube.com/channel/UCaVOiK81-Z30BGDnM2Udslw',
//                'rss' => 'https://turkmenportal.com/rss',
            );
        }

        $this->publishAssets();
        parent::init();
    }


    public function run()
    {


        $this->render('SocialIconsWidget', array());
    }


    public function publishAssets()
    {
        $assets = dirname(__FILE__) . '/assets';
        $baseUrl = Yii::app()->assetManager->publish($assets);
        if (is_dir($assets)) {
            Yii::app()->clientScript->registerCssFile($baseUrl . '/css/social.css');
//            Yii::app()->clientScript->registerScriptFile($baseUrl . '/js/jssor.slider.min.js', CClientScript::POS_END);
        } else {
            throw new CHttpException(500, __CLASS__ . ' - Error: Couldn\'t find assets to publish.');
        }
    }
}

?>
