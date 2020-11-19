<?php

class BannerController extends Controller
{

    public $layout = '//layouts/column2_admin';


    public function filters()
    {
        return array('rights - leave');
    }

    //public function allowedActions() { return 'createQuick,create';}


    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Banner');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionCreate()
    {
        $files = new XUploadForm;
        $model = new Banner;
        if (isset($_POST['Banner'])) {
            $model->setAttributes($_POST['Banner']);
            try {
                $model->documents = Documents::model()->saveDocuments('banners', 'state_banner', true);
                if ($model->saveWithRelated(array('documents'))) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('/bannerType/update', 'id' => $model->type));
                    }
                } else {
                    $this->redirect(Yii::app()->createUrl("//bannerType/update", array('id' => $model->type)));
                }
            } catch (Exception $e) {
                $model->addError('id', $e->getMessage());
            }
        } elseif (isset($_GET['Banner'])) {
            $model->attributes = $_GET['Banner'];
        }

        $this->render('create', array('model' => $model, 'files' => $files));
    }


    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        $files = new XUploadForm;

        if (isset($_POST['Banner'])) {
            $model->setAttributes($_POST['Banner']);
//            echo "<pre>";
//            print_r($model->attributes);
//            echo "</pre>";
//            exit(1);
//            try {
            $model->documents = Documents::model()->saveDocuments('banners', 'state_banner', true);
            if ($model->saveWithRelated(array('documents' => array('append' => true)))) {
                if (isset($_GET['returnUrl'])) {
                    $this->redirect($_GET['returnUrl']);
                } else {
                    $this->redirect(array('/bannerType/update', 'id' => $model->type));
                }
            } else {
                $this->redirect(Yii::app()->createUrl("//bannerType/update", array('id' => $model->type)));
            }
//            } catch (Exception $e) {
//                $model->addError('id', $e->getMessage());
//            }

        }

        $this->render('update', array(
            'model' => $model,
            'files' => $files,
        ));
    }


    public function actionDelete($id)
    {
//        if(Yii::app()->request->isPostRequest) {    
        try {
            $bannerModel = $this->loadModel($id);
            $documents = $bannerModel->documents;
            if (isset($documents)) {
                foreach ($documents as $doc) {
                    $doc->fullDelete('tbl_banner_to_documents');
                }
            }
            $bannerModel->delete();
        } catch (Exception $e) {
            throw new CHttpException(500, $e->getMessage());
        }

        if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
            $this->redirect(array('admin'));
        }
//        }
//        else
//            throw new CHttpException(400,
//                Yii::t('app', 'Invalid request.'));
    }


    public function actionAdmin()
    {
        $model = new Banner('search');
        $model->unsetAttributes();

        if (isset($_GET['Banner']))
            $model->setAttributes($_GET['Banner']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function loadModel($id)
    {
        $model = Banner::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        return $model;
    }


    public function actionLeave($url)
    {
        if (isset($url)) {
            if (isset($_GET['banner_id'])) {
                $bannerModel = Banner::model()->findByPk($_GET['banner_id']);
                if (isset($bannerModel)) {
                    $bannerActivityService = new BannerActivityService();
                    $bannerActivityService->registerActivity($bannerModel, BannerActivity::ACTIVITY_TYPE_CLICK);
                }
            }
            $this->redirect($url, true);
        } else {
            $this->redirect(Yii::app()->user->returnUrl);
        }
    }
}