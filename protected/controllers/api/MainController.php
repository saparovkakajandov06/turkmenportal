<?php

class MainController extends Controller
{
    const path = [
        'news' => 'blogs',
        'photoreport' => 'medias',
        'compositions' => 'compositions',
        'billboard' => 'posts'
    ];

    public function actionCategory()
    {
        $category = Category::model()->enabled()->topmenu()->mobile()->findAll();

        if (strlen($_GET['from-date']) > 0 && Yii::app()->controller->validateDateTime($_GET['from-date'], 'Y-n-j H:i:s')){
            $fromDate = $_GET['from-date'];
        } else {
            $fromDate = null;
        }

        foreach ($category as $key => $model) {
            $childCategory = new Category();
            $childCategory = $childCategory->getChilds($model->id);
            $alias = self::path[$model->code];

            $totalCount = 0;
            $childData = [];
            foreach ($childCategory as $k => $cat) {
                $postCount = $this->{$this->getFunction($alias)}($cat->id, $fromDate);
                $childData[] = [
                    'id' => (int)$cat->id,
                    'name_tm' => $cat->name_tm,
                    'name_ru' => $cat->name_ru,
                    'name_en' => $cat->name_en,
                    'post_count' => $postCount,
                    'parent_id' => $cat->parent_id,
                ];
                $totalCount = $totalCount + $postCount;
            }

            $data['models'][] = array(
                'id' => (int)$model->id,
                'name_tm' => $model->name_tm,
                'name_ru' => $model->name_ru,
                'name_en' => $model->name_en,
                'parent_id' => $model->parent_id,
                'alias' => $alias,
                'post_count' => $totalCount,
                'child' => $childData
            );
        }

        header('Content-Type: application/json; charset=UTF-8');
        echo Json::encode($data);
        die;
    }

    public function getFunction($model)
    {
        return 'get'.ucfirst($model);
    }

    public function getBlogs($id, $fromDate)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('category_id', $id);
        $criteria->compare('status', 1);
        if (!empty($fromDate)){
            $criteria->addCondition("t.date_added >= :pub_date_start and t.date_added <= :pub_date_end");
            $criteria->params = array_merge($criteria->params, array(':pub_date_start' => $fromDate , ':pub_date_end' => date('Y-m-d H:i:s')));
        }
        return Blog::model()->count($criteria);
    }

    public function getMedias($id, $fromDate)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('category_id', $id);
        $criteria->compare('status', 1);
        if (!empty($fromDate)){
            $criteria->addCondition("t.date_added >= :pub_date_start and t.date_added <= :pub_date_end");
            $criteria->params = array_merge($criteria->params, array(':pub_date_start' => $fromDate , ':pub_date_end' => date('Y-m-d H:i:s')));
        }
        return Photoreport::model()->count($criteria);
    }

    public function getCompositions($id, $fromDate)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('category_id', $id);
        $criteria->compare('status', 1);
        if (!empty($fromDate)){
            $criteria->addCondition("t.date_added >= :pub_date_start and t.date_added <= :pub_date_end");
            $criteria->params = array_merge($criteria->params, array(':pub_date_start' => $fromDate , ':pub_date_end' => date('Y-m-d H:i:s')));
        }

        return Compositions::model()->count($criteria);
    }

    public function getPosts($id, $fromDate)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('category_id', $id);
        $criteria->compare('status', 1);
        if (!empty($fromDate)){
            $criteria->addCondition("t.date_added >= :pub_date_start and t.date_added <= :pub_date_end");
            $criteria->params = array_merge($criteria->params, array(':pub_date_start' => $fromDate , ':pub_date_end' => date('Y-m-d H:i:s')));
        }
        return Catalog::model()->count($criteria);
    }



}