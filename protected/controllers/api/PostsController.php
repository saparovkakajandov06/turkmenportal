<?php

//use applications.components.Json;

//use yii\helpers\Json;

class PostsController extends Controller
{

    public function actionIndex()
    {
        if (isset($_GET['cat_id'])){
            if ($_GET['cat_id'] == 0){
                $cat_id = 283;
            } else
                $cat_id = (int)$_GET['cat_id'];
        } else{
            $cat_id = 283;
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
        $modelCatalog = new CatalogWrapper('search');
        $modelCategory = Category::model()->findByPk($cat_id);
        $modelCatalog->unsetAttributes();

        if (isset($modelCategory) && isset($modelCategory->parent_id) && $modelCategory->parent_id > 0)
            $modelCatalog->category_id = $modelCategory->id;
        elseif (isset ($modelCategory) && ($modelCategory->parent_id == null || $modelCategory->parent_id == 0))
            $modelCatalog->parent_category_id = $modelCategory->id;

        $dataProvider = $modelCatalog->apiSearchForCategory($per_page, $page);
        $models = $dataProvider->getData();


        foreach ($models as $key => $model){
            $data['models'][] = array(
                'id' => (int)$model->id,
                'title' => $model->getTitle(),
//                'content' => $model->getContent(),
                'image_url' => 'https://turkmenportal.com'.$model->getThumbPath(512, 288, 'w'),
                'thumb_url' => 'https://turkmenportal.com'.$model->getThumbPath(100, 100, 'w'),
                'date' => $model->date_added,
                'cat_name' => $model->category->name,
                'cat_id' => (int)$model->category->id,
                'view_count' => (int)$model->views,
                'address' => $model->address,
                'phone' => $model->phone,
                'web_site' => $model->web,
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
            $data['model'] = (object)array(
                'id' => (int)$model->id,
                'title' => $model->getTitle(),
                'content' => $model->getContent(),
                'image_url' => 'https://turkmenportal.com'.$model->getThumbPath(512, 288, 'w'),
//            'thumb_url' => 'https://turkmenportal.com'.$model->getThumbPath(100, 100, 'w'),
                'date' => $model->date_added,
                'cat_name' => $model->category->name,
                'cat_id' => (int)$model->category->id,
                'view_count' => (int)$model->views,
                'address' => $model->address,
                'phone' => $model->phone,
                'web_site' => $model->web,
                'url' => $model->getUrl(),
            );
        }
        if (!isset($data)){
            $data =(object)$data;
        }
        header('Content-Type: application/json; charset=UTF-8');
        echo Json::encode($data);die;
    }

    public function loadModel($id)
    {
        $model = Catalog::model()->findByPk($id);

        return $model;
    }
}