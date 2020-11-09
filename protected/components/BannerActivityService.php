<?php

class BannerActivityService
{

    public function registerActivity($bannerModel, $activity_type = BannerActivity::ACTIVITY_TYPE_VIEW)
    {

        if (isset($bannerModel) && isset($activity_type)) {
//            $bannerActivityModel = new BannerActivity();
//            $bannerActivityModel->banner_id = $bannerModel->id;
//            $bannerActivityModel->activity_type = $activity_type;
//            if ($bannerActivityModel->save()) {
            if (isset($activity_type)) {
                switch ($activity_type) {
                    case BannerActivity::ACTIVITY_TYPE_VIEW:
                        $bannerModel->saveCounters(array('view_count' => 1));
                        break;
                    case BannerActivity::ACTIVITY_TYPE_CLICK:
                        $bannerModel->saveCounters(array('click_count' => 1));
                        break;
                }
            }
//            }
        }
    }


}