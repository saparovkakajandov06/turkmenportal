<?php

class BlogsController extends Controller
{

    public function actionIndex()
    {
        if (isset($_GET['cat_id'])){
            if ($_GET['cat_id'] == 0){
                $cat_id = 282;
            } else
                $cat_id = (int)$_GET['cat_id'];
        } else{
            $cat_id = 282;
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

        $modelBlog = new Blog('search');
        $modelCategory = Category::model()->findByPk($cat_id);


        if (isset($modelCategory) && isset($modelCategory->parent_id) && $modelCategory->parent_id > 0){
            $modelBlog->category_id = $modelCategory->id;
        }
    elseif (isset ($modelCategory) && ($modelCategory->parent_id == null || $modelCategory->parent_id == 0))
        $modelBlog->parent_category_id = $modelCategory->id;
        $dataProvider = $modelBlog->apiSearchForCategory($per_page, $page);
        $models = $dataProvider->getData();

        foreach ($models as $key => $model){
            $data['models'][] = array(
                'id' => (int)$model->id,
                'title' => $model->getTitle(),
//                'content' => $model->getText(),
                'image_url' => 'https://turkmenportal.com'.$model->getThumbPath(512, 288, 'w'),
                'thumb_url' => 'https://turkmenportal.com'.$model->getThumbPath(256, 144, 'w'),
                'date' => $model->date_added,
                'cat_name' => $model->category->name,
                'cat_id' => (int)$model->category->id,
                'view_count' => (int)$model->visited_count,
//                'url' => $model->createAbsoluteUrl(),
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

        $image = 'https://turkmenportal.com'.$model->getThumbPath(512, 288, 'w');
        $image_info = getimagesize($image);
        $image_width = $image_info[0];
        $image_height = $image_info[1];
        if (isset($model)){
            $content = $model->getText();
            $pattern = '/src="/';
            $replacements = 'src="https://turkmenportal.com';
            $content = preg_replace($pattern,$replacements, $content);
            $data['model'] = (object)array(
                'id' => (int)$model->id,
                'title' => $model->getTitle(),
                'content' => $content,
                'image_url' => $image,
                'img_width' => $image_width,
                'img_height' => $image_height,
//                'thumb_url' => 'https://turkmenportal.com'.$model->getThumbPath(100, 100, 'w'),
                'date' => $model->date_added,
                'cat_name' => $model->category->name,
                'cat_id' => (int)$model->category->id,
                'view_count' => (int)$model->visited_count,
                'url' => $model->createAbsoluteUrl(),
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
        $blogModel = new Blog();
        $blogModel->unsetAttributes();
        $blogModel->default_scope = array('enabled', 'not_photoreport','sort_trend_asc');
        $blogModel->reset_related_sort = true;
        $popularDataProvider = $blogModel->searchForCategory(6);
        $models = $popularDataProvider->getData();

        foreach ($models as $key => $model){
            $data['models'][] = array(
                'id' => (int)$model->id,
                'title' => $model->getTitle(),
//                'content' => $model->getText(),
                'image_url' => 'https://turkmenportal.com'.$model->getThumbPath(512, 288, 'w'),
                'thumb_url' => 'https://turkmenportal.com'.$model->getThumbPath(256, 144, 'w'),
                'date' => $model->date_added,
                'cat_name' => $model->category->name,
                'cat_id' => (int)$model->category->id,
                'view_count' => (int)$model->visited_count,
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
        $model = Blog::model()->findByPk($id);
        return $model;
    }

}