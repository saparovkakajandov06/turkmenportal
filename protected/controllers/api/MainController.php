<?php

class MainController extends Controller
{
    const path = [
        'news' => 'blogs',
        'photoreport' => 'medias',
        'compositions' => 'compositions',
        'billboard' => 'posts'
    ];

    public function actionGetcount($id, $path, $hl){

        if (isset($_GET['hl'])){
            if ($_GET['hl'] == 'tm' || $_GET['hl'] == 'ru' || $_GET['hl'] == 'en')
                $hl = $_GET['hl'];
        } else {
            $hl = 'ru';
        }

        $data = $this->{'get'.ucfirst($path)}($id,'title_'.$hl);

        header('Content-Type: application/json; charset=UTF-8');
        echo Json::encode([
            'model' => ucfirst($path),
            'count' => $data-1
        ]);die;
    }

    public function getFunction($model)
    {
        return 'get'.ucfirst($model);
    }

    public function getBlogs($id, $hl)
    {
        $criteria = new CDbCriteria;
        $model = Blog::model()->findAllByPk($id);
        
        $criteria->compare('parent_category_id', $model->parent_category_id);
        $criteria->compare('status', 1);
        if (!empty((int)$id)){
            $criteria->addCondition("t.".$hl." is not null AND CHAR_LENGTH(t.".$hl.")>10");
            $criteria->addCondition("t.id >= :id");
            $criteria->params = array_merge($criteria->params, array(':id' => $id ));
        }

        return Blog::model()->count($criteria);
    }

    public function getMedias($id, $hl)
    {
        $criteria = new CDbCriteria;
        $model = Photoreport::model()->findAllByPk($id);

        $criteria->compare('parent_category_id', $model->parent_category_id);
        $criteria->compare('status', 1);
        if (!empty((int)$id)){
            $criteria->addCondition("t.".$hl." is not null AND CHAR_LENGTH(t.".$hl.")>10");
            $criteria->addCondition("t.id >= :id");
            $criteria->params = array_merge($criteria->params, array(':id' => $id ));
        }

        return Photoreport::model()->count($criteria);
    }

    public function getCompositions($id, $hl)
    {
        $criteria = new CDbCriteria;
        $model = Compositions::model()->findAllByPk($id);

        $criteria->compare('parent_category_id', $model->parent_category_id);
        $criteria->compare('status', 1);
        if (!empty((int)$id)){
            $criteria->addCondition("t.".$hl." is not null AND CHAR_LENGTH(t.".$hl.")>10");
            $criteria->addCondition("t.id >= :id");
            $criteria->params = array_merge($criteria->params, array(':id' => $id ));
        }

        return Compositions::model()->count($criteria);
    }

    public function getPosts($id, $hl)
    {
        $criteria = new CDbCriteria;
        $model = Catalog::model()->findAllByPk($id);

        $criteria->compare('parent_category_id', $model->parent_category_id);
        $criteria->compare('status', 1);
        if (!empty((int)$id)){
            $criteria->addCondition("t.".$hl." is not null AND CHAR_LENGTH(t.".$hl.")>10");
            $criteria->addCondition("t.id >= :id");
            $criteria->params = array_merge($criteria->params, array(':id' => $id ));
        }
        return Catalog::model()->count($criteria);
    }

    public function actionAds()
    {
        $model = Information::model()->findByPk(2);

        if (isset($_GET['id']))
            $id = (int)$_GET['id'];
        if (isset($_GET['hl'])){
            if ($_GET['hl'] == 'tm' || $_GET['hl'] == 'ru' || $_GET['hl'] == 'en')
                $hl = $_GET['hl'];
        } else {
            $hl = 'ru';
        }

        yii::app()->language = $hl;

        $content = $model->getMixedDescriptionModel()->description;

        $pattern = '/&nbsp;/';
        $replacements = ' ';
        $content = preg_replace($pattern,$replacements, $content);
        $pattern = '/src="/';
        $replacements = 'src="https://turkmenportal.com';
        $content = preg_replace($pattern,$replacements, $content);


        header('Content-Type: application/json; charset=UTF-8');
        echo Json::encode([
            'content' => $this->removePtagsOutImg($content),
        ]);die;
    }
}
