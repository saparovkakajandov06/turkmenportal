<?php

class BlogsController extends Controller
{

    public function actionIndex()
    {
        if (isset($_GET['cat_id']))
            $cat_id = (int)$_GET['cat_id'];
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
        echo CJSON::encode($data);die;
    }

}