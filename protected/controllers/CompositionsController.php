<?php

class CompositionsController extends Controller
{

    public $layout = '//layouts/column2_admin';


    public function filters()
    {
        return array('rights - update,delete',);
    }

    //public function allowedActions() { return 'createQuick,create';}


    public function actionIndex($path = null, $category_id = null, $region_id = null)
    {
        if (isset($category_id)) {
            $modelCategory = Category::model()->findByPk($category_id);
            if (Yii::app()->request->requestUri != $modelCategory->url)
                $this->redirect($modelCategory->url, true, 301);
        }

        $this->layout = '//layouts/composition/column2';

        if (!isset($_GET['Compositions_sort']))
            $_GET['Compositions_sort'] = 'date_added.desc';


        $modelCategory = Category::model()->findByPath($path);

        if (isset($modelCategory))
            $this->setMetaFromCategory($modelCategory);
        else {
            $path_tr = Category::model()->translatePath($path);
            $modelCategory = Category::model()->findByPath($path_tr);
            if (isset($modelCategory))
                $this->redirect($modelCategory->url, true);
            throw new CHttpException(404, 'Not found');
        }

        $compositionsModel = new Compositions('search');
        $compositionsModel->unsetAttributes();

        if (isset($modelCategory) && isset($modelCategory->parent_id) && $modelCategory->parent_id > 0)
            $compositionsModel->category_id = $modelCategory->id;
        elseif (isset ($modelCategory) && ($modelCategory->parent_id == null || $modelCategory->parent_id == 0))
            $compositionsModel->parent_category_id = $modelCategory->id;


        $this->render('index', array(
            'modelCategory' => $modelCategory,
            'compositionsModel' => $compositionsModel,
        ));
    }


    public function actionView($id)
    {
        $this->layout = '//layouts/composition/column2';
        if (isset ($_GET['ajax']) && $_GET['ajax'] == 'comments_listview') {
            $this->renderPartial('//comments/listview', array('related_relation' => 'compositions', 'related_relation_id' => $id));
        } else {
            $model = $this->loadModelFromCache($id);
            $lang_title = 'title_' . Yii::app()->language;
            $boll = true;
            if (Yii::app()->user->id){
                $boll =false;
            } elseif ($model->status == 1) {
                $boll = false;
            }
            if ($model === null || !isset($model->{$lang_title}) || strlen(trim($model->{$lang_title})) < 5 || $boll)
                throw new CHttpException(404, 'Not found');

            $url = $model->getUrl();
            Yii::app()->clientScript->registerLinkTag('canonical', null, $url);
            if (strpos(Yii::app()->request->url, 'index.php') !== false)
                $this->redirect($url, true, 301);

            if (Yii::app()->getBaseUrl(true) . Yii::app()->request->getOriginalUrl() != $url)
                $this->redirect($url, true, 301);

            $count = $model->incCounter('views', 1);
            $model->views = $count;
            $this->render('view', array(
                'model' => $model,
            ));
        }
    }


    public function actionCreate()
    {
        $photos = new XUploadForm;
        $model = new Compositions;
        $model->reloadTempList();

        $model->parent_category_id = Category::model()->findParentCategoryByCode('compositions');
        $model->category_code = 'compositions';
        if (isset($_POST['Compositions'])) {
            $model->setAttributes($_POST['Compositions']);

            try {
                $committed = false;
                $transaction = Yii::app()->db->beginTransaction();
                $model->documents = Documents::model()->saveDocuments('compositions', $model->state_name, true);
                if ($model->saveWithRelated(array('documents' => array('append' => true)))) {
                    $transaction->commit();
                    $committed = true;
                }
            } catch (Exception $e) {
                $transaction->rollBack();
                Yii::app()->user->setFlash('error', "Statya doredilmedi");
                $model->addError('id', $e->getMessage());
            }

            if ($committed == true) {
                $this->sendAlertEmail($model, 'compositions/view', 'Composition doredildi');
                EUserFlash::setSuccessMessage('Statya doredildi');
                if (isset($_POST['save_create'])) {
                    $this->redirect(array('//compositions/create'));
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
        Yii::app()->cache->delete($id . '_' . Compositions::tableName());
        $model = $this->loadModel($id);

        $params = array('create_username' => $model->create_username);
        if (!Yii::app()->user->checkAccess('Compositions.Update', $params)) {
            throw new CHttpException(403, Rights::t('core', 'You are not authorized to perform this action.'));
        }

        $model->parent_category_id = Category::model()->findParentCategoryByCode('compositions');
        $model->category_code = 'compositions';
        if (isset($_POST['Compositions'])) {
            $model->setAttributes($_POST['Compositions']);

            $committed = false;
            $transaction = Yii::app()->db->beginTransaction();
            $model->documents = Documents::model()->saveDocuments('compositions', $model->state_name, true);

            try {
                if ($model->saveWithRelated(array('documents' => array('append' => false)))) {
                    $transaction->commit();
                    $committed = true;
                }
            } catch (Exception $e) {
                $transaction->rollBack();
                Yii::app()->user->setFlash('error', "Statya doredilmedi");
                $model->addError('id', $e->getMessage());
            }
            if ($committed == true) {
                $this->sendAlertEmail($model, 'compositions/view', 'Composition uytgedilidi');
                EUserFlash::setSuccessMessage('Statya doredildi');
                $this->redirect(array('admin'));
            }
        } else {
            $model->reloadTempList(!isset($_SERVER['HTTP_X_REQUESTED_WITH']));
            $model->reloadDocumentsList(true);
        }


        $this->render('update', array(
            'model' => $model,
            'photos' => $photos,
        ));
    }


    public function actionDelete($id)
    {
        $model = $this->loadModel($id);
        $params = array('create_username' => $model->create_username);
        if (!Yii::app()->user->checkAccess('Compositions.Delete', $params)) {
            throw new CHttpException(403, Rights::t('core', 'You are not authorized to perform this action.'));
        }

        if (Yii::app()->request->isPostRequest) {
            try {
                $model->delete();
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
        $model = new Compositions('search');
        $model->unsetAttributes();

        if (isset($_GET['Compositions']))
            $model->setAttributes($_GET['Compositions']);

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
            if ($model->save()) {
                $title = 'Composition uytgedildi uytgan field: ' . $model->getAttributeLabel($attribute) . ' - ' . $model->$attribute;
                $this->sendAlertEmail($model, 'compositions/view', $title);
            }

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function loadModel($id)
    {
        $model = Compositions::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        return $model;
    }

    public function loadModelFromCache($id)
    {

        $model = Yii::app()->cache->get($id . '_' . Compositions::tableName());

        if (!$model){
            $model = Compositions::model()->findByPk($id);
            Yii::app()->cache->set($id . '_' . Compositions::tableName(), $model, Yii::app()->params['cache_duration']);
        }

        if ($model === null)
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        return $model;
    }

}