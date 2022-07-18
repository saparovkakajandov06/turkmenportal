<?php

require_once( __DIR__ . '/../predis/autoload.php');
Predis\Autoloader::register();

class EstatesController extends Controller
{

    public $layout = '//layouts/column2_admin';


    public function filters()
    {
        return array('rights - cron');
    }

//    public function allowedActions() { return 'createQuick,create';}

    public  function actionCron(){
        echo "</br>CRON ESATE BEGIN";
        $criteria = new CDbCriteria;
        $criteria->addCondition('date_end < NOW()');
        $rownum=Estates::model()->updateAll(array('status'=>0),$criteria);
        echo "</br>Total updated ".$rownum.' cloumns';
        echo "</br>CRON ESATE END";
    }


    public function actionIndex($path = null, $category_id = null)
    {
        if (isset($category_id)) {
            $modelCategory = Category::model()->findByPk($category_id);
            if (Yii::app()->request->requestUri != $modelCategory->url)
                $this->redirect($modelCategory->url, true, 301);
        }

        $this->layout = '//layouts/column2';

        if (!isset($_GET['Estates_sort']))
            $_GET['Estates_sort'] = 'date_added.desc';

        $modelEstates = new Estates('search');
        $modelEstates->unsetAttributes();
        if (isset($_GET['Estates'])) {
            $modelEstates->setAttributes($_GET['Estates']);
        }

        if (isset($path) && strlen(trim($path)) > 0)
            $modelCategory = Category::model()->findByPath($path);
        elseif (isset($category_id))
            $modelCategory = Category::model()->findByPk($category_id);
        else
            $modelCategory = Category::model()->no_parent()->findByAttributes(array('code' => 'estates'));


        if (isset($modelCategory) && isset($modelCategory->parent_id) && $modelCategory->parent_id > 0)
            $modelEstates->category_id = $modelCategory->id;

        $this->setMetaFromCategory($modelCategory);
        $this->render('index', array(
            'modelCategory' => $modelCategory,
            'modelEstates' => $modelEstates,
        ));
    }


    public function actionView($id)
    {
        $this->layout = '//layouts/column2';
        if (isset ($_GET['ajax']) && $_GET['ajax'] == 'comments_listview') {
            $this->renderPartial('//comments/listview', array('related_relation' => 'estates', 'related_relation_id' => $id));
        } else {
            $model = $this->loadModel($id);
            if ($model->status != 1)
                throw new CHttpException(404, 'Not found');
            $url = $model->getUrl();
            Yii::app()->clientScript->registerLinkTag('canonical', null, $url);
            if (strpos(Yii::app()->request->url, 'index.php') !== false)
                $this->redirect($url, true, 301);

            $this->meta_description = $model->description;
            $this->meta_keyword = $model->category->getFullTitle(false,',');
            if (isset($model->title) && strlen(trim($model->title)) > 0)
                $this->pageTitle = $model->title;
            else
                $this->pageTitle = $model->description;
            $this->pageTitle=$this->pageTitle.' | '.Yii::app()->params['title'];
        }

        //Redis
        $client = new Predis\Client();

        if (!$client->exists('view_count_estates_' . $id))
            $client->set('view_count_estates_' . $id, 0);

        $client->incr('view_count_estates_' . $id);
//        $model->saveCounters(array('views' => 1));

        $this->render('view', array(
            'model' => $model,
        ));
    }


    public function actionCreate()
    {
        $model = new Estates;
        $descriptions = array();
        $languages = Language::model()->findAllByAttributes(array('status' => 1));
        foreach ($languages as $language) {
            $descriptionModel = new EstatesDescription();
            $descriptionModel->language_id = $language->id;
            $descriptions[$language->id] = $descriptionModel;
        }


        if (isset($_POST['Estates']) && isset($_POST['EstatesDescription'])) {
            $model->setAttributes($_POST['Estates']);
            $model->descriptions = $_POST['EstatesDescription'];
            try {
                $committed = false;
                $transaction = Yii::app()->db->beginTransaction();
                if ($model->saveWithRelated(array())) {
                    $transaction->commit();
                    $committed = true;
                } else
                    $descriptions = $model->descriptions;
            } catch (Exception $e) {
                $transaction->rollBack();
                Yii::app()->user->setFlash('error', "Estates doredilmedi");
                $model->addError('', $e->getMessage());
            }

            if ($committed == true) {
                EUserFlash::setSuccessMessage('Doredildi');
                if (isset($_GET['returnUrl'])) {
                    $this->redirect($_GET['returnUrl']);
                } else {
                    $this->redirect(array('view', 'id' => $model->id));
                }
            }
        }

        $this->render('create', array(
            'model' => $model,
            'descriptions' => $descriptions,
        ));
    }


    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        $descriptions = array();
        $languages = Language::model()->findAllByAttributes(array('status' => 1));
        foreach ($languages as $language) {
            $descriptionModel = EstatesDescription::model()->findByAttributes(array('language_id' => $language->id, 'estates_id' => $model->id));
            if (isset ($descriptionModel))
                $descriptions[$language->id] = $descriptionModel;
            else {
                $descriptionModel = new EstatesDescription();
                $descriptionModel->language_id = $language->id;
                $descriptions[$language->id] = $descriptionModel;
            }
        }


        if (isset($_POST['Estates']) && isset($_POST['EstatesDescription'])) {
            $model->setAttributes($_POST['Estates']);
            $model->descriptions = $_POST['EstatesDescription'];

            $committed = false;
            $transaction = Yii::app()->db->beginTransaction();
            try {
                if ($model->saveWithRelated(array())) {
                    $transaction->commit();
                    $committed = true;
                } else
                    $descriptions = $model->descriptions;
            } catch (Exception $e) {
                $transaction->rollBack();
                Yii::app()->user->setFlash('error', "Estates doredilmedi");
                $model->addError('', $e->getMessage());
            }
            if ($committed == true) {
                EUserFlash::setSuccessMessage('Estates doredildi');
                $this->redirect(array('admin'));
            }
        }

        $this->render('update', array(
            'model' => $model,
            'descriptions' => $descriptions,
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
        $model = new Estates('search');
        $model->unsetAttributes();

        if (isset($_GET['Estates']))
            $model->setAttributes($_GET['Estates']);

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
        $model = Estates::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        return $model;
    }


    public function actionGeneralCreate()
    {
        {
            $photos = new XUploadForm;
            $model = new Estates();
            $model->status = Estates::STATUS_ENABLED;
            $descriptionModel = new EstatesDescription();
            $descriptionModel->language_id = Yii::app()->session['current_lang_id'];


            $this->layout = '//layouts/column2';
            $flag = true;
            if (isset($_POST['Estates']) && isset($_POST['EstatesDescription'])) {
                $flag = false;
                $model->attributes = $_POST['Estates'];
                $descriptionModel->attributes = $_POST['EstatesDescription'];
                $model->descriptions = array($descriptionModel);

                try {
                    $committed = false;
                    $transaction = Yii::app()->db->beginTransaction();
                    $model->documents = Documents::model()->saveDocuments('estates', 'state_estates', true);
                    if ($model->saveWithRelated(array('descriptions', 'documents'))) {
                        $transaction->commit();
                        $committed = true;
                    } else
                        $descriptionModel = $model->descriptions[0];
                } catch (Exception $e) {
                    $transaction->rollBack();
                    Yii::app()->user->setFlash('error', "Auto doredilmedi");
                    $model->addError('id', $e->getMessage());
                }

                if ($committed == true) {
                    $message = "URL: " . Yii::app()->createUrl('//estates/view', array('id' => $model->id));
                    UserModule::sendMail(Yii::app()->params['adminEmail'], Yii::t('app', 'tp_obyawa_goshuldy'), $message);
                    EUserFlash::setSuccessMessage('Doredildi');
                    echo CJSON::encode(array(
                        'status' => 'success',
                        'redirect' => Yii::app()->createUrl('//estates/view', array('id' => $model->id)),
                        'message' => Yii::t('app', 'client_form_confirmation_message'),
                    ));
                    Yii::app()->end();
                } else {
                    echo CJSON::encode(array(
                        'status' => 'error',
                        'message' => CActiveForm::validate(array($model, $descriptionModel)),
                    ));
                    Yii::app()->end();
                }
            }

//            $this->render('general', array('model' => $model,'descriptionModel'=>$descriptionModel,'photos'=>$photos), false, true);
        }
    }





//      public function actionCategory($category_id=null){
//        $this->layout='//layouts/column2';
//        
//        if(isset($category_id))
//            $modelCategory = Category::model()->findByPk($category_id);
//        else
//            $modelCategory = Category::model()->no_parent()->findByAttributes(array('code'=>'estate'));
//        
//        $modelEstates = new Estates('search');
//        $modelEstates->unsetAttributes();
//        if (isset($_GET['Estates'])){
//                $modelEstates->setAttributes($_GET['Estates']);
//        }
//        $this->setMetaFromCategory($modelCategory);
//        $this->render('category', array(
//                'modelCategory' => $modelCategory,
//                'modelEstates' => $modelEstates,
//        ));
//    }

}