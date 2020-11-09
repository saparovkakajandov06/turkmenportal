<?php

class PhotoreportController extends Controller
{

    public $layout = '//layouts/column2_admin';


    public function filters()
    {
        return array('rights',);
    }

    //public function allowedActions() { return 'createQuick,create';}


    public function actionIndex($path = null, $category_id = null, $region_id = null)
    {
        $this->layout = '//layouts/blog/column2';
        if (isset($category_id)) {
            $modelCategory = Category::model()->findByPk($category_id);
            if (Yii::app()->request->requestUri != $modelCategory->url)
                $this->redirect($modelCategory->url, true, 301);
        }


        $modelPhotoreport = new Photoreport('search');
        $modelCategory = Category::model()->findByPath($path);

        if (isset($modelCategory))
            $this->setMetaFromCategory($modelCategory);
        else {
            $path_tr = Category::model()->translatePath($path);
            $modelCategory = Category::model()->findByPath($path_tr);
            if (isset($modelCategory))
                $this->redirect($modelCategory->url, true);
            throw new CHttpException(404, 'Not found');

            //$modelCategory =  Category::model()->no_parent()->findByAttributes(array('code'=>'photoreport'));
            //$this->setMetaFromCategory($modelCategory);
        }


        if (isset($modelCategory) && isset($modelCategory->parent_id) && $modelCategory->parent_id > 0)
            $modelPhotoreport->category_id = $modelCategory->id;
        elseif (isset ($modelCategory) && ($modelCategory->parent_id == null || $modelCategory->parent_id == 0))
            $modelPhotoreport->parent_category_id = $modelCategory->id;


        $this->render('index', array(
            'modelCategory' => $modelCategory,
            'modelPhotoreport' => $modelPhotoreport,
        ));
    }


    public function actionView($id)
    {
        $this->layout = '//layouts/catalog/column2';
        if (isset ($_GET['ajax']) && $_GET['ajax'] == 'comments_listview') {
            $this->renderPartial('//comments/listview', array('related_relation' => 'blogs', 'related_relation_id' => $id));
        } else {
            $model = $this->loadModel($id);
            $lang_title = 'title_' . Yii::app()->language;
            if ($model === null || !isset($model->{$lang_title}) || strlen(trim($model->{$lang_title})) < 5 || $model->status != 1)
                throw new CHttpException(404, 'Not found');
            $url = $model->getUrl();
            Yii::app()->clientScript->registerLinkTag('canonical', null, $url);
            if (strpos(Yii::app()->request->url, 'index.php') !== false)
                $this->redirect($url, true, 301);

            $model->saveCounters(array('visited_count' => 1));
            $this->render('view', array(
                'model' => $model,
            ));
        }
    }


    public function actionLike($id)
    {
        if (Yii::app()->request->isAjaxRequest) {
            $model = $this->loadModel($id);
            if ($model->saveCounters(array('like_count' => 1))) {
                echo CJSON::encode(array(
                    'status' => 'success',
                    'message' => Yii::t('app', 'comment_like_success'),
                ));
            }
        } else
            echo CJSON::encode(array(
                'status' => 'error',
                'message' => Yii::t('app', 'comment_like_error'),
            ));
    }


    public function actionDislike($id)
    {
        if (Yii::app()->request->isAjaxRequest) {
            $model = $this->loadModel($id);
            if ($model->saveCounters(array('dislike_count' => 1))) {
                echo CJSON::encode(array(
                    'status' => 'success',
                    'message' => Yii::t('app', 'dislike_success'),
                ));
            }
        } else {
            echo CJSON::encode(array(
                'status' => 'error',
                'message' => Yii::t('app', 'dislike_error'),
            ));
        }
    }


    public function actionCreate()
    {
        $photos = new XUploadForm;
        $model = new Blog;
        $model->blog_category_id = 282;

        if (isset($_POST['Blog'])) {
            $model->setAttributes($_POST['Blog']);
            $model->tagstm->setTags($_POST['tagstm']);
            $model->tagsru->setTags($_POST['tagsru']);
            try {
                $committed = false;
                $transaction = Yii::app()->db->beginTransaction();
                $model->documents = Documents::model()->saveDocuments('blogs', 'state_blogs', true);
                if ($model->saveWithRelated(array('regions', 'documents' => array('append' => true)))) {
                    $transaction->commit();
                    $committed = true;
                }
            } catch (Exception $e) {
                $transaction->rollBack();
                Yii::app()->user->setFlash('error', "Blog doredilmedi");
                $model->addError('id', $e->getMessage());
            }

            if ($committed == true) {
                EUserFlash::setSuccessMessage('Doredildi');
                if (isset($_POST['save_create'])) {
                    $this->redirect(array('//blog/create'));
                } else {
                    $this->redirect(array('admin'));
                }
            }
        }

        $this->render('create', array(
            'model' => $model,
            'photos' => $photos,
        ));
    }


    public function actionUpdate($id)
    {
        $photos = new XUploadForm;
        $model = $this->loadModel($id);
        $model->blog_category_id = 282;


        if (isset($_POST['Blog'])) {
            $model->setAttributes($_POST['Blog']);
            if (isset($_POST['Blog']['regions'])) $model->regions = $_POST['Blog']['regions'];

            $committed = false;
            $transaction = Yii::app()->db->beginTransaction();
            $model->documents = Documents::model()->saveDocuments('blogs', 'state_blogs', true);
            $model->tagstm->setTags($_POST['tagstm']);
            $model->tagsru->setTags($_POST['tagsru']);
            try {
                if ($model->saveWithRelated(array('regions', 'documents' => array('append' => true)))) {
                    $transaction->commit();
                    $committed = true;
                } else {
                    $model->documents = Documents::model()->saveDocuments('blogs', 'state_blogs');
                }
            } catch (Exception $e) {
                $transaction->rollBack();
                Yii::app()->user->setFlash('error', "Blog doredilmedi");
                $model->addError('id', $e->getMessage());
            }
            if ($committed == true) {
                EUserFlash::setSuccessMessage('Blog doredildi');
                $this->redirect(array('admin'));
            }
        }

        $this->render('update', array(
            'model' => $model,
            'photos' => $photos,
        ));
    }


    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            try {
                $this->loadModel($id)->delete();
            } catch (Exception $e) {
                throw new CHttpException(500, $e->getMessage());
            }

            if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
                $this->redirect(array('admin'));
            }
        } else
            throw new CHttpException(400,
                Yii::t('app', 'Invalid request.'));
    }


    public function actionAdmin()
    {

        $model = new Blog('search');
        $model->unsetAttributes();

        if (isset($_GET['Blog']))
            $model->setAttributes($_GET['Blog']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }


    public function actionToggle($id, $attribute, $model)
    {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $model = $this->loadModel($id, $model);
            //loadModel($id, $model) from giix
            ($model->$attribute == 1) ? $model->$attribute = 0 : $model->$attribute = 1;
            $model->save();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }


    public function loadModel($id)
    {
        $model = Photoreport::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        return $model;
    }


}