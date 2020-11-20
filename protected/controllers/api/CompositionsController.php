<?php

//use applications.components.Json;

//use yii\helpers\Json;

class CompositionsController extends Controller
{

    public function actionIndex()
    {
        if (isset($_GET['cat_id'])){
            if ($_GET['cat_id'] == 0){
                $cat_id = 355;
            } else
                $cat_id = (int)$_GET['cat_id'];
        } else{
            $cat_id = 355;
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
        $modelComposition = new CompositionsWrapper('search');
        $modelCategory = Category::model()->findByPk($cat_id);
        $modelComposition->unsetAttributes();

        if (isset($modelCategory) && isset($modelCategory->parent_id) && $modelCategory->parent_id > 0)
            $modelComposition->category_id = $modelCategory->id;
        elseif (isset ($modelCategory) && ($modelCategory->parent_id == null || $modelCategory->parent_id == 0))
            $modelComposition->parent_category_id = $modelCategory->id;

        $dataProvider = $modelComposition->apiSearchForCategory($per_page, $page);
        $models = $dataProvider->getData();


        foreach ($models as $key => $model){
            $data['models'][] = array(
                'id' => (int)$model->id,
                'title' => $model->getTitle(),
//                'content' => $model->getContent(),
//                'image_url' => Yii::app()->createAbsoluteUrl($model->getThumbPath(512, 288, 'w')),
                'thumb_url' => Yii::app()->createAbsoluteUrl($model->getThumbPath(256, 144, 'w')),
                'date' => $model->date_added,
                'cat_name' => $model->category->name,
                'cat_id' => (int)$model->category->id,
//                'view_count' => (int)$model->views,
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




        $data['models'][] = array(
            'id' => (int)$model->id,
            'title' => $model->getTitle(),
            'content' => $model->getContent(),
            'image_url' => Yii::app()->createAbsoluteUrl($model->getThumbPath(512, 288, 'w')),
//            'thumb_url' => Yii::app()->createAbsoluteUrl($model->getThumbPath(256, 144, 'w')),
            'date' => $model->date_added,
            'cat_name' => $model->category->name,
            'cat_id' => (int)$model->category->id,
            'view_count' => (int)$model->views,
            'url' => $model->getUrl(),
        );
        if (!isset($data)){
            $data['models'] = [];
        }
        header('Content-Type: application/json; charset=UTF-8');
        echo Json::encode($data);die;
    }

    public function loadModel($id)
    {
        $model = Compositions::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        return $model;
    }

}