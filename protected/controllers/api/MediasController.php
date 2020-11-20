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
            if ($_GET['hl'] == 'tm' || $_GET['hl'] == 'ru' || $_GET['hl'] == 'en')
                $hl = $_GET['hl'];
        } else {
            $hl = 'ru';
        }
        yii::app()->language = $hl;
        $modelBlog = new BlogWrapper('search');
        $modelCategory = Category::model()->findByPk($cat_id);


        if (isset($modelCategory) && isset($modelCategory->parent_id) && $modelCategory->parent_id > 0){
            $modelBlog->category_id = $modelCategory->id;
        }
        elseif (isset ($modelCategory) && ($modelCategory->parent_id == null || $modelCategory->parent_id == 0))
            $modelBlog->parent_category_id = $modelCategory->id;
        $dataProvider = $modelBlog->apiSearchForCategory($per_page, $page);
        $models = $dataProvider->getData();

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
                    'thumb_url' => Yii::app()->createAbsoluteUrl($thumb_url),
//                    'image_url' => Yii::app()->createAbsoluteUrl($image_url),
//                    'video_url' => Yii::app()->createAbsoluteUrl($videoPath),

                ];
            } else {
                $mainDoc = $model->getDocument();
                unset($image_url);
                unset($thumb_url);
                unset($images);
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
                    'thumb_url' => Yii::app()->createAbsoluteUrl($thumb_url),
//                    'image_url' => Yii::app()->createAbsoluteUrl($image_url),
//                    'image_urls' => Yii::app()->createAbsoluteUrl($images),

                ];
            }

            $data = array(
                'id' => (int)$model->id,
                'title' => $model->getTitle(),
//                'content' => $model->getText(),
                'date' => $model->date_added,
                'cat_name' => $model->category->name,
                'cat_id' => (int)$model->category->id,
                'view_count' => (int)$model->visited_count,
                'url' => $model->createAbsoluteUrl(),
            );
            $result['models'][] =array_merge($data,$extra);
        }
        header('Content-Type: application/json; charset=UTF-8');
        echo Json::encode($result);die;
    }


    public function actionView()
    {
        if (isset($_GET['id']))
            $id = (int)$_GET['id'];
        if (isset($_GET['hl'])){
            if ($_GET['hl'] == 'tm' || $_GET['hl'] == 'ru' || $_GET['hl'] == 'en')
                $hl = $_GET['hl'];
        } else {
            $hl = 'ru';
        }
        yii::app()->language = $hl;
        $model = $this->loadModel($id);


        if (isset($model)){
            $mainDoc = $model->getDocument();
            if (isset($mainDoc) && $mainDoc->getVideoPath()) {
                $extra = [];
                $image_url = $mainDoc->resize(512, 288, 'crop', false, false);
                $thumb_url = $mainDoc->resize(256, 144, 'crop', false, false);
                $videoPath = $mainDoc->getVideoUrl();
                $type = 'video/mp4';
                $extra = [
                    'type' => $type,
                    'thumb_url' => Yii::app()->createAbsoluteUrl($thumb_url),
                    'image_url' => Yii::app()->createAbsoluteUrl($image_url),
                    'video_url' => Yii::app()->createAbsoluteUrl($videoPath),

                ];
            } else {
                $mainDoc = $model->getDocument();
                unset($image_url);
                unset($thumb_url);
                unset($images);
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
                    'thumb_url' => Yii::app()->createAbsoluteUrl($thumb_url),
                    'image_url' => Yii::app()->createAbsoluteUrl($image_url),
                    'image_urls' => Yii::app()->createAbsoluteUrl($images),

                ];
            }
            if (isset($model)){
                $data = array(
                    'id' => (int)$model->id,
                    'title' => $model->getTitle(),
                    'content' => $model->getText(),
                    'date' => $model->date_added,
                    'cat_name' => $model->category->name,
                    'cat_id' => (int)$model->category->id,
                    'view_count' => (int)$model->visited_count,
                    'url' => $model->createAbsoluteUrl(),
                );
                $result['model'] =array_merge($data,$extra);
            }
        }
        if (!isset($result)){
            $result =(object)$result;
        }
        $result = (object)$result;
        header('Content-Type: application/json; charset=UTF-8');
        echo Json::encode($result);die;
    }

    public function loadModel($id)
    {
        $model = Blog::model()->findByPk($id);
        return $model;
    }

}