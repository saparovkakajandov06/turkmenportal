<?php

class BannersWidget extends CWidget
{
    public $type;
    public $format_type;
    public $width;
    public $height;
    public $outer_css_class;
    public $link_css_class;
    public $outer_css_id;
    public $outer_css_style;
    public $inner_css_style;
    public $is_mobile;
    public $ajax = false;


    public function init()
    {
        parent::init();
        if (!isset($this->is_mobile)) {
            $this->is_mobile = false;
        }
        if (!isset($this->outer_css_id))
            $this->outer_css_id = "nivo-slider";
    }


    public function run()
    {
        $bannerTypeModel = BannerType::model()->findByAttributes(array('type_name' => $this->type, 'status' => 1));
        $calculate_show = true;
        if (Yii::app()->mobileDetect->isMobile() || Yii::app()->mobileDetect->isTablet() || Yii::app()->mobileDetect->isIphone()) {
            if ($this->is_mobile == true || ($bannerTypeModel->is_mobile_enabled == BannerType::BANNER_TYPE_ALL || $bannerTypeModel->is_mobile_enabled == BannerType::BANNER_TYPE_MOBILE_ONLY)) {
                $calculate_show = true;
            } else {
                $calculate_show = false;
            }
        } else {
            if (($bannerTypeModel->is_mobile_enabled == BannerType::BANNER_TYPE_ALL || $bannerTypeModel->is_mobile_enabled == BannerType::BANNER_TYPE_DESKTOP_ONLY)) {
                $calculate_show = true;
            } else {
                $calculate_show = false;
            }
        }

        if ($calculate_show) {
            if ($this->ajax == false) {
                if (isset($bannerTypeModel)) {
                    $bannerModel = null;
                    $banners = $bannerTypeModel->getEnabledBanners();
                    if (count($banners) > 0) {
                        if (!isset($this->width))
                            $this->width = $bannerTypeModel->width;
                        if (!isset($this->height))
                            $this->height = $bannerTypeModel->height;

                        //detect exact banner to show
                        switch ($bannerTypeModel->type) {
                            case BannerType::TYPE_FLASH:
                            case BannerType::TYPE_IMAGE:
                            case BannerType::TYPE_IMAGE_SLIDER:
                                $bannerModel = $banners[0];
                                break;
                            case BannerType::TYPE_ADSENSE:
                                $is_mobile = Yii::app()->controller->isMobile();
                                foreach ($banners as $banner) {
                                    if ($is_mobile == true && $banner->format_type == Banner::FORMAT_TYPE_MOBILE) {
                                        $bannerModel = $banner;
                                        break;
                                    } elseif ($is_mobile == false && $banner->format_type == Banner::FORMAT_TYPE_DESKTOP) {
                                        $bannerModel = $banner;
                                        break;
                                    }
                                }
                                break;
                            case BannerType::TYPE_IMAGE_RANDOM:
                                if (!isset(Yii::app()->params[$this->type])){
                                    $countBanner = count($banners);
                                    for ($i = 0; $i < $countBanner; $i++){
                                        $arr[] = $i;
                                    }
                                    shuffle($arr);
                                    Yii::app()->params[$this->type] = $arr;
                                    Yii::app()->params[$this->type.'Order'] = 0;
                                }

                                if (Yii::app()->params[$this->type.'Order'] >= count(Yii::app()->params[$this->type])){
                                    Yii::app()->params[$this->type.'Order'] = 0;
                                }
                                if (isset(Yii::app()->params[$this->type][Yii::app()->params[$this->type.'Order']])){
                                    $order = Yii::app()->params[$this->type][Yii::app()->params[$this->type.'Order']];
                                    $bannerModel = $banners[$order];
                                    Yii::app()->params[$this->type.'Order'] = Yii::app()->params[$this->type.'Order'] + 1;
                                } else
                                    $bannerModel = $banners[array_rand($banners)];
                                break;
                        }
                    }


                    $bannerActivityService = new BannerActivityService();
                    $bannerActivityService->registerActivity($bannerModel, BannerActivity::ACTIVITY_TYPE_VIEW);

                    $this->render('BannersWidget', array('bannerTypeModel' => $bannerTypeModel, 'banners' => $banners, 'bannerModel' => $bannerModel));
                }
            } else {
                $this->render('BannersWidget', array());
            }
        }
    }
}

?>
