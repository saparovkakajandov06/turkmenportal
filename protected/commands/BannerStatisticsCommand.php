<?php


class BannerStatisticsCommand extends CConsoleCommand
{

    public function actionFix()
    {
        $criteria=new CDbCriteria;
        $criteria->select='id, view_count, click_count, status';  // выбираем только поле 'title'
        $criteria->condition='status=:postID';
        $criteria->params=array(':postID'=>1);
        $banners = Banner::model()->findAll($criteria); // $params не требуется


        foreach ($banners as $banner) {

            $bannerStat = new BannerStatistics;

            $bannerStat->banner_id = $banner->id;
            $bannerStat->view_count = $banner->view_count;
            $bannerStat->click_count = $banner->click_count;
            $bannerStat->status = $banner->status;
            $bannerStat->date_created = $bannerStat->date_updated = date('Y-m-d H:i:s');
            $bannerStat->save();
        }

        return 0;
    }
}