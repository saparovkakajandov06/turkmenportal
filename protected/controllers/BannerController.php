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



                    $bannerStat = new BannerStatistics;

                    $bannerStat->banner_id = $model->id;
                    $bannerStat->view_count = $model->view_count;
                    $bannerStat->click_count = $model->click_count;
                    $bannerStat->status = $model->status;
                    $bannerStat->date_created = $bannerStat->date_updated = date('Y-m-d H:i:s');
                    $bannerStat->save();


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
        $bannerFix = false;

        if (isset($_POST['Banner'])) {

            $bannerFix = !($model->status == $_POST['Banner']['status']);

            $model->setAttributes($_POST['Banner']);
//            echo "<pre>";
//            print_r($model->attributes);
//            echo "</pre>";
//            exit(1);
//            try {
            $model->documents = Documents::model()->saveDocuments('banners', 'state_banner', true);
            if ($model->saveWithRelated(array('documents' => array('append' => true)))) {
                if ($bannerFix) {

                    $bannerStatistics = new BannerStatistics;
                    $bannerStatistics->banner_id = $model->id;
                    $bannerStatistics->click_count = $model->click_count;
                    $bannerStatistics->view_count = $model->view_count;
                    $bannerStatistics->status = $model->status;
                    $bannerStatistics->date_created = $bannerStatistics->date_updated = date('Y-m-d H:i:s');
                    $bannerStatistics->save();
                }

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


    public function actionStatistics($id){

        $model = Banner::model()->with('banner_type')->findByPk($id);

        $criteria = new CDbCriteria;
        $criteria->select='*';  // выбираем только поле 'title'
        $criteria->condition='banner_id=:postID';
        $criteria->params=array(':postID'=>$id);
        $banners = BannerStatistics::model()->findAll($criteria);

        $type['id']     = $model->banner_type->id;
        $type['name']   = $model->banner_type->type_name;

        $this->render('statistics', array(
            'description'     => $model->description,
            'type'      => $type,
            'banners'   => $banners
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

            $bannerStatistics = new BannerStatistics;

            $exists = $bannerStatistics->exists("banner_id = :id", [":id" => $id]);

            if ($exists){
                $bannerStatistics->deleteAll("banner_id = :id", [":id" => $id]);
            }


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