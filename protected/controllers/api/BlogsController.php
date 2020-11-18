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
            $data['models'][] = array(
                'id' => $model->id,
                'title' => $model->getTitle(),
                'description' => $model->getDescription(),
                'content' => $model->getText(),
                'thumb_url' => $model->getThumbPath(512, 288, 'w'),
                'image_url' => $model->getThumbPath(256, 144, 'w'),
                'date' => $model->date_added,
                'cat_name' => $model->category->name,
                'cat_id' => $model->category->id,
                'par_cat_name' => $model->category->parent->name,
                'par_cat_id' => $model->category->parent->id,
                'view_count' => $model->visited_count,
                'url' => $model->createAbsoluteUrl(),
            );
        }
        header('Content-Type: application/json; charset=UTF-8');
        echo Json::encode($data);die;
    }

    public function actionTop()
    {
        $blogModel = new Blog();
        $blogModel->unsetAttributes();
        $blogModel->default_scope = array('enabled', 'not_photoreport','sort_trend_asc');
        $blogModel->reset_related_sort = true;
        $popularDataProvider = $blogModel->searchForCategory(6);
        $models = $popularDataProvider->getData();
        foreach ($models as $key => $model){
            $data[] = array(
                'id' => $model->id,
                'title' => $model->getTitle(),
                'description' => $model->getDescription(),
                'content' => $model->getText(),
                'thumb_url' => Yii::app()->createAbsoluteUrl($model->getThumbPath(512, 288, 'w')),
                'image_url' => Yii::app()->createAbsoluteUrl($model->getThumbPath(256, 144, 'w')),
                'date' => $model->date_added,
                'cat_name' => $model->category->name,
                'cat_id' => $model->category->id,
                'par_cat_name' => $model->category->parent->name,
                'par_cat_id' => $model->category->parent->id,
                'view_count' => $model->visited_count,
                'url' => $model->createAbsoluteUrl(),
            );
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