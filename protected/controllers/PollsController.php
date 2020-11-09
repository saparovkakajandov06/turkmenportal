<?php
class PollsController extends Controller {

    public $layout='//layouts/column2_admin';



    public function filters() { return array( 'rights', ); } 
    //public function allowedActions() { return 'createQuick,create';}



    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Polls');
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
        $model = new Polls;
        $descriptions=array();
        $languages=  Language::model()->findAllByAttributes(array('status'=>1));
        foreach ($languages as $language) {
            $descriptionModel=new PollsDescription();
            $descriptionModel->language_id=$language->id;
            $descriptions[$language->id]=$descriptionModel;
        }
        
                    
            
        if (isset($_POST['Polls']) && isset($_POST['PollsDescription'])) {
                $model->setAttributes($_POST['Polls']);
                $model->descriptions = $_POST['PollsDescription'];
                    try {
                        $committed=false;
                        $transaction = Yii::app()->db->beginTransaction();
                           if($model->saveWithRelated( array('descriptions'))){
                                $transaction->commit();
                                $committed=true;
                           }else
                                $descriptions=$model->descriptions;
                    } catch (Exception $e) {
                        $transaction->rollBack();
                        Yii::app()->user->setFlash('error',  "Polls doredilmedi");
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
            $descriptionModel=  PollsDescription::model()->findByAttributes(array('language_id'=>$language->id,'polls_id'=>$model->id));
            if(isset ($descriptionModel))
                $descriptions[$language->id]=$descriptionModel;
            else{
                $descriptionModel=new PollsDescription();
                $descriptionModel->language_id=$language->id;
                $descriptions[$language->id]=$descriptionModel;
            }
        }
        
        
        if (isset($_POST['Polls']) && isset($_POST['PollsDescription'])) {
                $model->setAttributes($_POST['Polls']);
                $model->descriptions = $_POST['PollsDescription'];
                                
                    $committed=false;
                    $transaction = Yii::app()->db->beginTransaction();
                    try {
                           if($model->saveWithRelated( array('descriptions'))){
                                $transaction->commit();
                                $committed=true;
                           }else
                                $descriptions=$model->descriptions;
                    } catch (Exception $e) {
                         $transaction->rollBack();
                         Yii::app()->user->setFlash('error',  "Polls doredilmedi");
                         $model->addError('id', $e->getMessage());
                    }
                    if($committed==true)
                    {
                         EUserFlash::setSuccessMessage('Polls doredildi');
                         $this->redirect(array('admin'));
                    }
            }

            $this->render('update',array(
                    'model'=>$model,
                    'descriptions'=>$descriptions,
            ));
    }
                
               

    public function actionResults($id) {
        if(isset($id)){
            $pollsModel=  Polls::model()->findByPk($id);
            $answers=$pollsModel->answers;
            if(isset($answers) && count($answers)>0)
            {
                Yii::app()->clientScript->scriptMap['jquery.js'] = false;
                $this->renderPartial('//polls/_results', array('pollsModel'=>$pollsModel,'answers' => $answers), false, true);
            }
        }
    }
   
    public function actionPoll($id) {
        if(isset($id)){
            $this->widget('PollsWidget', array('poll_id' => $id)); 
        }
    }
    
    
    public function actionAnswer($id) {
        if(isset($_POST['PollsAnswers']['id']) && strlen(trim($_POST['PollsAnswers']['id']))>0){
            $pollsAnswers= PollsAnswers::model()->findByPk($_POST['PollsAnswers']['id']);
            if(isset($pollsAnswers)){
                $pollsAnswers->likes++;
                if($pollsAnswers->save()){
                    $this->actionResults($id);
                }
            }
        }
    }
    
    
    public function actionDelete($id) {
        if(Yii::app()->request->isPostRequest) {    
            try {
                PollsDescription::model()->deleteAllByAttributes(array('polls_id'=>$id));
                $pollsAnswers=PollsAnswers::model()->findAllByAttributes(array('polls_id'=>$id));
                foreach ($pollsAnswers as $pollsAnswer) {
                    PollsAnswersDescription::model()->deleteAllByAttributes(array('polls_answers_id'=>$pollsAnswer->id));
                    $pollsAnswer->delete();
                }
                
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
        $model = new Polls('search');
        $model->unsetAttributes();

        if (isset($_GET['Polls']))
                $model->setAttributes($_GET['Polls']);

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
            $model=Polls::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,Yii::t('app', 'The requested page does not exist.'));
            return $model;
    }

}