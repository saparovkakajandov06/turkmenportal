<?php
class PollsDescriptionController extends Controller {

    public $layout='//layouts/column2_admin';



    public function filters() { return array( 'rights', ); } 
    //public function allowedActions() { return 'createQuick,create';}



    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('PollsDescription');
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
        $model = new PollsDescription;
                if (isset($_POST['PollsDescription'])) {
            $model->setAttributes($_POST['PollsDescription']);

                
                try {
                    if($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                            $this->redirect($_GET['returnUrl']);
                    } else {
                            $this->redirect(array('view','id'=>$model->id));
                    }
                }
                } catch (Exception $e) {
                        $model->addError('id', $e->getMessage());
                }
        } elseif(isset($_GET['PollsDescription'])) {
                        $model->attributes = $_GET['PollsDescription'];
        }

        $this->render('create',array( 'model'=>$model));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        
        if(isset($_POST['PollsDescription'])) {
            $model->setAttributes($_POST['PollsDescription']);
                try {
                    if($model->save()) {
                        if (isset($_GET['returnUrl'])) {
                                $this->redirect($_GET['returnUrl']);
                        } else {
                                $this->redirect(array('view','id'=>$model->id));
                        }
                    }
                } catch (Exception $e) {
                        $model->addError('id', $e->getMessage());
                }

            }

        $this->render('update',array(
                'model'=>$model,
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
        $model = new PollsDescription('search');
        $model->unsetAttributes();

        if (isset($_GET['PollsDescription']))
                $model->setAttributes($_GET['PollsDescription']);

        $this->render('admin', array(
                'model' => $model,
        ));
    }
    
    
    public function loadModel($id) {
            $model=PollsDescription::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,Yii::t('app', 'The requested page does not exist.'));
            return $model;
    }

}