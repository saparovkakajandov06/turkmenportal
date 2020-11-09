<?php
class PollsAnswersDescriptionController extends Controller {

    public $layout='//layouts/column2_admin';



    public function filters() { return array( 'rights', ); } 
    //public function allowedActions() { return 'createQuick,create';}



    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('PollsAnswersDescription');
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
        $model = new PollsAnswersDescription;
                if (isset($_POST['PollsAnswersDescription'])) {
            $model->setAttributes($_POST['PollsAnswersDescription']);

			 if (isset($_POST['PollsAnswersDescription']['language'])) $model->language = $_POST['PollsAnswersDescription']['language'];
			 if (isset($_POST['PollsAnswersDescription']['polls_answers'])) $model->polls_answers = $_POST['PollsAnswersDescription']['polls_answers'];
                
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
        } elseif(isset($_GET['PollsAnswersDescription'])) {
                        $model->attributes = $_GET['PollsAnswersDescription'];
        }

        $this->render('create',array( 'model'=>$model));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        
        if(isset($_POST['PollsAnswersDescription'])) {
            $model->setAttributes($_POST['PollsAnswersDescription']);
			$model->language = $_POST['PollsAnswersDescription']['language'];
			$model->polls_answers = $_POST['PollsAnswersDescription']['polls_answers'];
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
        $model = new PollsAnswersDescription('search');
        $model->unsetAttributes();

        if (isset($_GET['PollsAnswersDescription']))
                $model->setAttributes($_GET['PollsAnswersDescription']);

        $this->render('admin', array(
                'model' => $model,
        ));
    }
    
    
    public function loadModel($id) {
            $model=PollsAnswersDescription::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,Yii::t('app', 'The requested page does not exist.'));
            return $model;
    }

}