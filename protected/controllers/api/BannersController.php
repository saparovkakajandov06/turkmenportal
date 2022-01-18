<?php

class BannersController extends Controller
{

    public $bannerMap = [
        'BannerA' => 'mobileBannerA',
        'BannerB' => 'mobileBannerB',
        'BannerC' => 'mobileBannerC',
        'BannerD' => 'mobileBannerD',
        'BannerE' => 'mobileBannerE',
        'BannerF' => 'bannerNesipetsin',
        'BannerG' => 'mobileBannerG',
        'BannerH' => 'mobileBannerH',
        'BannerJ' => 'mobileBannerVtop1',
        'BannerI' => 'mobileBannerVtop2',
    ];
    public $width;
    public $height;



    public function actionIndex()
    {
        if (isset($_GET['bannerType'])){
            $bannerType = $this->bannerMap[$_GET['bannerType']];
            $banner = $this->getBanner($bannerType);
            $bannerModel = $banner['bannerModel'];

            if (isset($bannerModel)) {
                if (isset($bannerModel->url) && strlen(trim($bannerModel->url)) > 3) {
                    $fullUrl = (strpos($bannerModel->url, 'http') === false) ? "http://" . $bannerModel->url : $bannerModel->url;
                    $fullUrl = Yii::app()->createUrl("banner/leave", array("url" => $fullUrl, 'banner_id' => $bannerModel->id));
                    $imgUrl = Documents::model()->getUploadedPath($bannerModel->getDocument()->path);
                    $banner = array(
                        'id' => $bannerModel->id,
                        'type' => $bannerType,
                        'description' => $bannerModel->description,
                        'img' => 'https://turkmenportal.com' . $imgUrl,
                        'fullUrl' => 'https://turkmenportal.com' . $fullUrl,
                    );
                } else {
                    $imgUrl = Documents::model()->getUploadedPath($bannerModel->getDocument()->path);
                    $banner = array(
                        'id' => $bannerModel->id,
                        'type' => $bannerType,
                        'description' => $bannerModel->description,
                        'img' => 'https://turkmenportal.com' . $imgUrl,
                    );
                }

            }
        }


        if (!isset($banner)) {
            $banner = [];
        }
        header('Content-Type: application/json; charset=UTF-8');
        echo Json::encode($banner);
        die;
    }


    public function getBanner($type)
    {

        $bannerTypeModel = Yii::app()->cache->get($type . '_' . BannerType::tableName());

        if (!$bannerTypeModel) {
            $bannerTypeModel = BannerType::model()->findByAttributes(array('type_name' => $type, 'status' => 1));
            Yii::app()->cache->set($type . '_' . BannerType::tableName(), $bannerTypeModel, Yii::app()->params['cache_duration']);
        }

        $calculate_show = true;
        if (($bannerTypeModel->is_mobile_enabled == BannerType::BANNER_TYPE_ALL || $bannerTypeModel->is_mobile_enabled == BannerType::BANNER_TYPE_MOBILE_ONLY)) {
            $calculate_show = true;
        } else {
            $calculate_show = false;
        }


        if ($calculate_show) {
            if (isset($bannerTypeModel)) {
                $bannerModel = null;
                $banners = $bannerTypeModel->getEnabledBanners();
                if (count($banners) > 0) {
                    $this->width = $bannerTypeModel->width;
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

                            $bannerModel = $banners[array_rand($banners)];

                            if (isset($_GET['id'])) {
                                while ($bannerModel->id == $_GET['id']) {
                                    $bannerModel = $banners[array_rand($banners)];
                                }
                            }
                            break;
                    }
                }

                if (isset($bannerModel)){
                    $view_count = $bannerModel->incCounter('view_count', BannerActivity::ACTIVITY_TYPE_VIEW);
                    $bannerModel->view_count = $view_count;
                }

                return array('bannerTypeModel' => $bannerTypeModel, 'banners' => $banners, 'bannerModel' => $bannerModel);
            }
        }
    }

}