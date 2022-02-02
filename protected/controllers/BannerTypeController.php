<?php
class BannerTypeController extends Controller {

    public $layout='//layouts/column2_admin';



    public function filters() { return array( 'rights', ); } 
    //public function allowedActions() { return 'createQuick,create';}



    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('BannerType');
        $this->render('index', array(
                'dataProvider' => $dataProvider,
        ));
    }
        
    public function actionView($id) {
        $this->render('view', array(
                'model' => $this->loadModel($id),
        ));
    }
        
    public function actionCreate() {
        $model = new BannerType;
                if (isset($_POST['BannerType'])) {
            $model->setAttributes($_POST['BannerType']);

                
                try {
                    if($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                            $this->redirect($_GET['returnUrl']);
                    } else {
                            $this->redirect(array('update','id'=>$model->id));
                    }
                }
                } catch (Exception $e) {
                        $model->addError('id', $e->getMessage());
                }
        } elseif(isset($_GET['BannerType'])) {
                        $model->attributes = $_GET['BannerType'];
        }

        $this->render('create',array( 'model'=>$model));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $bannerGridModel=new Banner();
        $bannerGridModel->unsetAttributes();
        $bannerGridModel->type=$id;
        
        if(isset($_GET['banner_id']) && strlen(trim($_GET['banner_id']))>0){
            $bannerModel=  Banner::model()->findByPk($_GET['banner_id']);
            $bannerGridModel->exceptions=array($_GET['banner_id']);
        }
        else
            $bannerModel=  new Banner();
        $bannerModel->type=$id;
        
        $photos = new XUploadForm;
        $bannerModel->reloadTempList();
        $bannerModel->reloadDocumentsList(true);
       
        
        
        if(isset($_POST['BannerType'])) {
            $model->setAttributes($_POST['BannerType']);
                try {
                    if($model->save()) {
                        if (isset($_GET['returnUrl'])) {
                                $this->redirect($_GET['returnUrl']);
                        } else {
                                $this->redirect(array('admin'));
                        }
                    }
                } catch (Exception $e) {
                        $model->addError('id', $e->getMessage());
                }

            }

        $this->render('update',array(
                'model'=>$model,
                'bannerModel'=>$bannerModel,
                'bannerGridModel'=>$bannerGridModel,
                'photos'=>$photos,
        ));
    }
                
               

    public function actionDelete($id) {
        if(Yii::app()->request->isPostRequest) {    
            try {
                $this->loadModel($id)->delete();
            } catch (Exception $e) {
                    throw new CHttpException(500,$e->getMessage());
            }

            if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
                            $this->redirect(array('admin'));
            }
        }
        else
            throw new CHttpException(400,
                Yii::t('app', 'Invalid request.'));
    }
                
    public function actionAdmin() {
        $model = new BannerType('search');
        $model->unsetAttributes();

        $bannerModel=new Banner();
        $bannerModel->emptyTempList();

        if (isset($_GET['BannerType']))
                $model->setAttributes($_GET['BannerType']);

        $this->render('admin', array(
                'model' => $model,
        ));
    }


    public function actionToggle($id, $attribute, $model) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $model = $this->loadModel($id, $model);
            //loadModel($id, $model) from giix
            ($model->$attribute == 1) ? $model->$attribute = 0 : $model->$attribute = 1;
            $model->save();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }



    public function loadModel($id) {
            $model=BannerType::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,Yii::t('app', 'The requested page does not exist.'));
            return $model;
    }

}