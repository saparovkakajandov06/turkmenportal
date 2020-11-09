<?php
class PollsAnswersController extends Controller {

    public $layout='//layouts/column2_admin';



    public function filters() { return array( 'rights', ); } 
    //public function allowedActions() { return 'createQuick,create';}



    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('PollsAnswers');
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
        $model = new PollsAnswers;
        $descriptions=array();
        $languages=  Language::model()->findAllByAttributes(array('status'=>1));
        foreach ($languages as $language) {
            $descriptionModel=new PollsAnswersDescription();
            $descriptionModel->language_id=$language->id;
            $descriptions[$language->id]=$descriptionModel;
        }
        
                    
            
        if (isset($_POST['PollsAnswers']) && isset($_POST['PollsAnswersDescription'])) {
                $model->setAttributes($_POST['PollsAnswers']);
                $model->descriptions = $_POST['PollsAnswersDescription'];
                                    try {
                        $committed=false;
                        $transaction = Yii::app()->db->beginTransaction();
                           if($model->saveWithRelated( array('descriptions',))){
                                $transaction->commit();
                                $committed=true;
                           }else
                                $descriptions=$model->descriptions;
                    } catch (Exception $e) {
                        $transaction->rollBack();
                        Yii::app()->user->setFlash('error',  "PollsAnswers doredilmedi");
                        $model->addError('id', $e->getMessage());
                    }
                    
                    if($committed==true)
                    {
                         EUserFlash::setSuccessMessage('Doredildi');
                         if (isset($_GET['returnUrl'])) {
                                $this->redirect($_GET['returnUrl']);
                        } else {
                                $this->redirect(array('view','id'=>$model->id));
                        }
                    }
        } 

        $this->render('create',array(
			'model'=>$model,
                        'descriptions'=>$descriptions,
        ));
    }

    
    
    
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $descriptions=array();
        $languages=  Language::model()->findAllByAttributes(array('status'=>1));
        foreach ($languages as $language) {
            $descriptionModel=  PollsAnswersDescription::model()->findByAttributes(array('language_id'=>$language->id,'polls_answers_id'=>$model->id));
            if(isset ($descriptionModel))
                $descriptions[$language->id]=$descriptionModel;
            else{
                $descriptionModel=new PollsAnswersDescription();
                $descriptionModel->language_id=$language->id;
                $descriptions[$language->id]=$descriptionModel;
            }
        }
        
        
        if (isset($_POST['PollsAnswers']) && isset($_POST['PollsAnswersDescription'])) {
                $model->setAttributes($_POST['PollsAnswers']);
                $model->descriptions = $_POST['PollsAnswersDescription'];
                                
                    $committed=false;
                    $transaction = Yii::app()->db->beginTransaction();
                    try {
                           if($model->saveWithRelated( array('descriptions',))){
                                $transaction->commit();
                                $committed=true;
                           }else
                                $descriptions=$model->descriptions;
                    } catch (Exception $e) {
                         $transaction->rollBack();
                         Yii::app()->user->setFlash('error',  "PollsAnswers doredilmedi");
                         $model->addError('id', $e->getMessage());
                    }
                    if($committed==true)
                    {
                         EUserFlash::setSuccessMessage('PollsAnswers doredildi');
                         $this->redirect(array('admin'));
                    }
            }

            $this->render('update',array(
                    'model'=>$model,
                    'descriptions'=>$descriptions,
            ));
    }
                
               

    public function actionDelete($id) {
        if(Yii::app()->request->isPostRequest) {    
            try {
                PollsAnswersDescription::model()->deleteAllByAttributes(array('polls-answers_id'=>$id));
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
        $model = new PollsAnswers('search');
        $model->unsetAttributes();

        if (isset($_GET['PollsAnswers']))
                $model->setAttributes($_GET['PollsAnswers']);

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
            $model=PollsAnswers::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,Yii::t('app', 'The requested page does not exist.'));
            return $model;
    }

}