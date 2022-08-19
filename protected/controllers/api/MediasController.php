<?php

require_once( __DIR__ . '/../../predis/autoload.php');
Predis\Autoloader::register();

class MediasController extends Controller
{

    public function actionIndex()
    {
        $_GET['api'] = true;
        if (isset($_GET['cat_id'])){
            if ($_GET['cat_id'] == 0){
                $cat_id = 338;
            } else
                $cat_id = (int)$_GET['cat_id'];
        } else{
            $cat_id = 338;
        }


        if (isset($_GET['hl'])){
            if ($_GET['hl'] == 'tm' || $_GET['hl'] == 'ru' || $_GET['hl'] == 'en')
                $hl = $_GET['hl'];
        } else {
            $hl = 'ru';
        }
        yii::app()->language = $hl;
        $modelBlog = new Photoreport('search');
        $modelCategory = Category::model()->findByPk($cat_id);
        $modelBlog->default_scope = array('enabled', 'sort_newest', 'sort_by_order_desc');

        if (isset($modelCategory) && isset($modelCategory->parent_id) && $modelCategory->parent_id > 0){
            $modelBlog->category_id = $modelCategory->id;
        }
        elseif (isset ($modelCategory) && ($modelCategory->parent_id == null || $modelCategory->parent_id == 0))
            $modelBlog->parent_category_id = $modelCategory->id;
        $dataProvider = $modelBlog->searchForCategory(null);
        $models = $dataProvider->getData();

        foreach ($models as $key => $model){

            $mainDoc = $model->getDocument();
            if (isset($mainDoc) && $mainDoc->getVideoPath()) {
                $extra = [];
                $image_url = $mainDoc->resize(720, 576, 'w', false, false);
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
                    $image_url = $mainDoc->resize(720, 576, 'w', false, false);
                    $thumb_url = $mainDoc->resize(256, 144, 'w', false, false);
                }
                $mainDoc = $model->documents();
                if (count($mainDoc) > 1){
                    $images = [];
                    foreach ($mainDoc as $doc){
                        $images[] = 'https://turkmenportal.com'.$doc->resize(720, 576, 'w', false, false);
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
        if (!isset($result)){
            $result['models'] = [];
        }
        header('Content-Type: application/json; charset=UTF-8');
        echo Json::encode($result);die;
    }


    public function actionTop()
    {
        $_GET['api'] = true;
        if (isset($_GET['cat_id'])){
            if ($_GET['cat_id'] == 0){
                $cat_id = 338;
            } else
                $cat_id = (int)$_GET['cat_id'];
        } else{
            $cat_id = 338;
        }

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
        $dataProvider = $modelBlog->apiSearchForCategory(null);
        $models = $dataProvider->getData();

        foreach ($models as $key => $model){

            $mainDoc = $model->getDocument();
            if (isset($mainDoc) && $mainDoc->getVideoPath()) {
                $extra = [];
                $image_url = $mainDoc->resize(720, 576, 'w', false, false);
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

        if (!isset($result)){
            $result['models'] = [];
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
        $lang = [];
        if (yii::app()->language != 'ru' && strlen($model->title_ru) > 0 && strlen($model->text_ru) > 0){
            $lang[] = 'ru';
        }
        if (yii::app()->language != 'tm' && strlen($model->title_tm) > 0 && strlen($model->text_tm) > 0){
            $lang[] = 'tm';
        }
        if (yii::app()->language != 'en' && strlen($model->title_en) > 0 && strlen($model->text_en) > 0) {
            $lang[] = 'en';
        }



        if (isset($model)){
            $mainDoc = $model->getDocument();
            if (isset($mainDoc) && $mainDoc->getVideoPath()) {
                $extra = [];
                $image_url = $mainDoc->resize(720, 576, 'w', false, false);
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
                    $image_url = $mainDoc->resize(720, 576, 'w', false, false);
                    $thumb_url = $mainDoc->resize(256, 144, 'w', false, false);
                }
                $mainDoc = $model->documents();
                if (count($mainDoc) > 1){
                    $images = [];
                    $thumbs = [];
                    foreach ($mainDoc as $doc){
                        $images[] = 'https://turkmenportal.com'.$doc->resize(720, 576, 'w', false, false);
                        $thumbs[] = 'https://turkmenportal.com'.$doc->resize(256, 144, 'w', false, false);
                    }
                }
                $extra = [
                    'type' => 'image',
                    'thumb_url' => 'https://turkmenportal.com'.$thumb_url,
                    'image_url' => 'https://turkmenportal.com'.$image_url,
                    'thumb_urls' => $thumbs,
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
                    'content' => $this->removePtagsOutImg($content),
                    'date' => $model->date_added,
                    'cat_name' => $model->category->name,
                    'cat_id' => (int)$model->category->id,
                    'view_count' => (int)$model->visited_count,
                    'url' => $model->createAbsoluteUrl(),
                    'lang' => $lang
                );
                $result['model'] =array_merge($data,$extra);

                $client = new Predis\Client();

                if (!$client->exists('view_count_blog_' . $id))
                    $client->set('view_count_blog_' . $id, 0);

                $client->incr('view_count_blog_' . $id);
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