<?php

//use applications.components.Json;

//use yii\helpers\Json;

class CompositionsController extends Controller
{

    public function actionIndex()
    {
        $_GET['api'] = true;

        if (isset($_GET['cat_id'])){
            if ($_GET['cat_id'] == 0){
                $cat_id = 355;
            } else
                $cat_id = (int)$_GET['cat_id'];
        } else{
            $cat_id = 355;
        }

        if (isset($_GET['hl'])){
            if ($_GET['hl'] == 'tm' || $_GET['hl'] == 'ru' || $_GET['hl'] == 'en')
                $hl = $_GET['hl'];
        } else {
            $hl = 'ru';
        }
        yii::app()->language = $hl;

        if (!isset($_GET['Compositions_sort']))
            $_GET['Compositions_sort'] = 'date_added.desc';

        $modelComposition = new Compositions('search');
        $modelCategory = Category::model()->findByPk($cat_id);
        $modelComposition->unsetAttributes();

        if (isset($modelCategory) && isset($modelCategory->parent_id) && $modelCategory->parent_id > 0)
            $modelComposition->category_id = $modelCategory->id;
        elseif (isset ($modelCategory) && ($modelCategory->parent_id == null || $modelCategory->parent_id == 0))
            $modelComposition->parent_category_id = $modelCategory->id;

        $dataProvider = $modelComposition->searchForIndex(null, false);
        $models = $dataProvider->getData();


        foreach ($models as $key => $model){
            $data['models'][] = array(
                'id' => (int)$model->id,
                'title' => $model->getTitle(),
//                'content' => $model->getContent(),
                'image_url' => 'https://turkmenportal.com'.$model->getThumbPath(720, 576, 'w'),
                'thumb_url' => 'https://turkmenportal.com'.$model->getThumbPath(256, 144, 'w'),
                'date' => $model->date_added,
                'cat_name' => $model->category->name,
                'cat_id' => (int)$model->category->id,
                'view_count' => (int)$model->views,
//                'url' => $model->getUrl(),
            );
        }
        if (!isset($data)){
            $data['models'] = [];
        }
        header('Content-Type: application/json; charset=UTF-8');
        echo Json::encode($data);die;
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
            $document = $model->getDocument();
            $image_source = $document->{title.'_'.$hl};
        }

        $image = $model->getThumbPath(720, 576, 'w');
        if (strlen($image) > 5){
            $image_info = getimagesize("/var/www/turkmenportal.com/public_html$image");
            $image = 'https://turkmenportal.com'.$image;
//            $image = 'http://95.85.126.182'.$image;
            $image_width = $image_info[0];
            $image_height = $image_info[1];
        }
        $lang = [];
        if (yii::app()->language != 'ru' && strlen($model->title_ru) > 0 && strlen($model->content_ru) > 0){
            $lang[] = 'ru';
        }
        if (yii::app()->language != 'tm' && strlen($model->title_tm) > 0 && strlen($model->content_tm) > 0){
            $lang[] = 'tm';
        }
        if (yii::app()->language != 'en' && strlen($model->title_en) > 0 && strlen($model->content_en) > 0){
            $lang[] = 'en';
        }


        if (isset($model)) {
            $content = $model->getContent();
            $pattern = '/&nbsp;/';
            $replacements = ' ';
            $content = preg_replace($pattern,$replacements, $content);
            $pattern = '/src="/';
            $replacements = 'src="https://turkmenportal.com';
            $content = preg_replace($pattern,$replacements, $content);
            $data['model'] = (object)array(
                'id' => (int)$model->id,
                'title' => $model->getTitle(),
                'content' => $this->removePtagsOutImg($content),
                'image_url' => $image,
                'img_width' => $image_width,
                'img_height' => $image_height,
                'img_source' => $image_source,
                'thumb_url' => 'https://turkmenportal.com'.$model->getThumbPath(256, 144, 'w'),
                'date' => $model->date_added,
                'cat_name' => $model->category->name,
                'cat_id' => (int)$model->category->id,
                'view_count' => (int)$model->views,
                'url' => $model->getUrl(),
                'lang' => $lang
            );
        }
        if (!isset($data)){
            $data =(object)$data;
        }
        header('Content-Type: application/json; charset=UTF-8');
        echo Json::encode($data);die;
    }

    public function actionTop()
    {
        if (isset($_GET['hl'])){
            if ($_GET['hl'] == 'tm' || $_GET['hl'] == 'ru' || $_GET['hl'] == 'en')
                $hl = $_GET['hl'];
        } else {
            $hl = 'ru';
        }
        yii::app()->language = $hl;
        $blogModel = new Compositions();
        $blogModel->unsetAttributes();
        $blogModel->default_scope = array('enabled','sort_trend_asc');
//        $blogModel->reset_related_sort = true;
        $_GET['per_page'] = 6;
        $popularDataProvider = $blogModel->searchForIndex(null,false);
        $models = $popularDataProvider->getData();

        foreach ($models as $key => $model){
            $data['models'][] = array(
                'id' => (int)$model->id,
                'title' => $model->getTitle(),
//                'content' => $model->getText(),
                'image_url' => 'https://turkmenportal.com'.$model->getThumbPath(720, 576, 'w'),
                'thumb_url' => 'https://turkmenportal.com'.$model->getThumbPath(256, 144, 'w'),
                'date' => $model->date_added,
                'cat_name' => $model->category->name,
                'cat_id' => (int)$model->category->id,
                'view_count' => (int)$model->views,
//                'url' => $model->createAbsoluteUrl(),
            );
        }
        if (!isset($data)){
            $data['models'] = [];
        }
        header('Content-Type: application/json; charset=UTF-8');
        echo Json::encode($data);die;
    }

    public function loadModel($id)
    {
        $model = Compositions::model()->findByPk($id);

        return $model;
    }

}