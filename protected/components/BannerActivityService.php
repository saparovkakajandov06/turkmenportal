<?php

require_once( __DIR__ . '/../predis/autoload.php');
Predis\Autoloader::register();

class BannerActivityService
{

    public function registerActivity($bannerModel, $activity_type = BannerActivity::ACTIVITY_TYPE_VIEW)
    {

        if (isset($bannerModel) && isset($activity_type)) {
//            $bannerActivityModel = new BannerActivity();
//            $bannerActivityModel->banner_id = $bannerModel->id;
//            $bannerActivityModel->activity_type = $activity_type;
//            if ($bannerActivityModel->save()) {

//            $client = new Predis\Client();

//            if (!$client->exists('view_count_banner_' . $bannerModel->id))
//                $client->set('view_count_banner_' . $bannerModel->id, 0);

            if (isset($activity_type)) {
                switch ($activity_type) {
                    case BannerActivity::ACTIVITY_TYPE_VIEW:

//                        $client->incr('view_count_banner_' . $bannerModel->id);
                        $bannerModel->saveCounters(array('view_count' => 1));
                        break;
                    case BannerActivity::ACTIVITY_TYPE_CLICK:

//                        $client->incr('click_count_banner_' . $bannerModel->id);
                        $bannerModel->saveCounters(array('click_count' => 1));
                        break;
                }
            }
//            }
        }
    }


}