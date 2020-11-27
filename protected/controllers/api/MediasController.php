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
                $image_url = $mainDoc->resize(512, 288, 'w', false, false);
                $thumb_url = $mainDoc->resize(256, 144, 'w', false, false);
                $videoPath = $mainDoc->getVideoUrl();
                $videoHlsPath = $mainDoc->getVideoHlsPlaylistUrl();
                $type = 'video/mp4';
                $extra = [
                    'type' => $type,
                    'thumb_url' => 'https://turkmenportal.com'.$thumb_url,
                    'image_url' => 'https://turkmenportal.com'.$image_url,
                    'video_url' => 'https://turkmenportal.com'.$videoPath,
                    'videoHlsPath' => 'https://turkmenportal.com'.$videoHlsPath,

                ];
            } else {
                $mainDoc = $model->getDocument();
                unset($image_url);
                unset($thumb_url);
                unset($images);
                if (isset($mainDoc)){
                    $image_url = $mainDoc->resize(512, 288, 'w', false, false);
                    $thumb_url = $mainDoc->resize(256, 144, 'w', false, false);
                }
                $mainDoc = $model->documents();
                if (count($mainDoc) > 1){
                    $images = [];
                    foreach ($mainDoc as $doc){
                        $images[] = 'https://turkmenportal.com'.$doc->resize(512, 288, 'w', false, false);
                    }
                }
                $extra = [
                    'type' => 'image',
                    'thumb_url' => 'https://turkmenportal.com'.$thumb_url,
                    'image_url' => 'https://turkmenportal.com'.$image_url,
                    'image_urls' =>$images,

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


    public function actionTop()
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
        $modelBlog->video = true;
        $dataProvider = $modelBlog->apiSearchForCategory($per_page, $page);
        $models = $dataProvider->getData();

        foreach ($models as $key => $model){

            $mainDoc = $model->getDocument();
            if (isset($mainDoc) && $mainDoc->getVideoPath()) {
                $per_page --;
                $extra = [];
                $image_url = $mainDoc->resize(512, 288, 'w', false, false);
                $thumb_url = $mainDoc->resize(256, 144, 'w', false, false);
                $videoPath = $mainDoc->getVideoUrl();
                $videoHlsPath = $mainDoc->getVideoHlsPlaylistUrl();
                $type = 'video/mp4';
                $extra = [
                    'type' => $type,
                    'thumb_url' => 'https://turkmenportal.com'.$thumb_url,
                    'image_url' => 'https://turkmenportal.com'.$image_url,
                    'video_url' => 'https://turkmenportal.com'.$videoPath,
                    'videoHlsPath' => 'https://turkmenportal.com'.$videoHlsPath,

                ];
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
                $image_url = $mainDoc->resize(512, 288, 'w', false, false);
                $thumb_url = $mainDoc->resize(256, 144, 'w', false, false);
                $videoPath = $mainDoc->getVideoUrl();
                $videoHlsPath = $mainDoc->getVideoHlsPlaylistUrl();
                $type = 'video/mp4';
                $extra = [
                    'type' => $type,
                    'thumb_url' => 'https://turkmenportal.com'.$thumb_url,
                    'image_url' => 'https://turkmenportal.com'.$image_url,
                    'video_url' => 'https://turkmenportal.com'.$videoPath,
                    'videoHlsPath' => 'https://turkmenportal.com'.$videoHlsPath,

                ];
            } else {
                $mainDoc = $model->getDocument();
                unset($image_url);
                unset($thumb_url);
                unset($images);
                if (isset($mainDoc)){
                    $image_url = $mainDoc->resize(512, 288, 'w', false, false);
                    $thumb_url = $mainDoc->resize(256, 144, 'w', false, false);
                }
                $mainDoc = $model->documents();
                if (count($mainDoc) > 1){
                    $images = [];
                    foreach ($mainDoc as $doc){
                        $images[] = 'https://turkmenportal.com'.$doc->resize(512, 288, 'w', false, false);
                    }
                }
                $extra = [
                    'type' => 'image',
                    'thumb_url' => 'https://turkmenportal.com'.$thumb_url,
                    'image_url' => 'https://turkmenportal.com'.$image_url,
                    'image_urls' => $images,

                ];
            }
            if (isset($model)){
                $content = $model->getText();
                $pattern = '/src="/';
                $replacements = 'src="https://turkmenportal.com';
                $content = preg_replace($pattern,$replacements, $content);
                $data = array(
                    'id' => (int)$model->id,
                    'title' => $model->getTitle(),
                    'content' => $content,
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