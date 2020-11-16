<?php

//use applications.components.Json;

//use yii\helpers\Json;

class MediasController extends Controller
{

    public function actionIndex()
    {
        if (isset($_GET['cat_id'])){
            if ($_GET['cat_id'] == 0){
                $cat_id = 338;
            } else
                $cat_id = (int)$_GET['cat_id'];
        } else{
            $cat_id = 338;
        }
        if (isset($_GET['page']))
            $page = (int)$_GET['page'];
        if (isset($_GET['per_page']))
            $per_page = (int)$_GET['per_page'];
        if (isset($_GET['hl'])){
            if ($_GET['hl'] == 'tm' && $_GET['hl'] == 'ru' && $_GET['hl'] == 'en')
                $hl = $_GET['hl'];
        } else {
            $hl = 'ru';
        }
        $modelBlog = new BlogWrapper('search');
        $modelCategory = Category::model()->findByPk($cat_id);


        if (isset($modelCategory) && isset($modelCategory->parent_id) && $modelCategory->parent_id > 0){
            $modelBlog->category_id = $modelCategory->id;
        }
        elseif (isset ($modelCategory) && ($modelCategory->parent_id == null || $modelCategory->parent_id == 0))
            $modelBlog->parent_category_id = $modelCategory->id;
        $dataProvider = $modelBlog->apiSearchForCategory($per_page, $page);
        $models = $dataProvider->getData();
        yii::app()->language = $hl;
        foreach ($models as $key => $model){

            $mainDoc = $model->getDocument();
            if (isset($mainDoc) && $mainDoc->getVideoPath()) {
                $extra = [];
                $image_url = $mainDoc->resize(512, 288, 'crop', false, false);
                $thumb_url = $mainDoc->resize(256, 144, 'crop', false, false);
                $videoPath = $mainDoc->getVideoUrl();
                $type = 'video/mp4';
                $extra = [
                    'type' => $type,
                    'thumb_url' => $thumb_url,
                    'image_url' => $image_url,
                    'video_url' => $videoPath,

                ];
            } else {
                $mainDoc = $model->getDocument();
                if (isset($mainDoc)){
                    $image_url = Yii::app()->createAbsoluteUrl($mainDoc->resize(512, 288, 'crop', false, false));
                    $thumb_url = Yii::app()->createAbsoluteUrl($mainDoc->resize(256, 144, 'crop', false, false));
                }
                $mainDoc = $model->documents();
                if (count($mainDoc) > 1){
                    $images = [];
                    foreach ($mainDoc as $doc){
                        $images[] = Yii::app()->createAbsoluteUrl($doc->resize(512, 288, 'crop', false, false));
                    }
                }
                $extra = [
                    'type' => 'image',
                    'thumb_url' => $thumb_url,
                    'image_url' => $image_url,
                    'image_urls' => $images,

                ];
            }

            $data = array(
                'id' => $model->id,
                'title' => $model->getTitle(),
                'description' => $model->getDescription(),
                'content' => $model->getText(),
                'date' => $model->date_added,
                'cat_name' => $model->category->name,
                'cat_id' => $model->category->id,
                'par_cat_name' => $model->category->parent->name,
                'par_cat_id' => $model->category->parent->id,
                'view_count' => $model->visited_count,
                'url' => $model->createAbsoluteUrl(),
            );
            $data =array_merge($data,$extra);
        }
        header('Content-Type: application/json; charset=UTF-8');
        echo Json::encode($data);die;
    }

}