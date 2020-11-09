<?php
class PageController extends Controller {

    public $layout='//layouts/column2_admin';



    public function filters() { return array( 'rights', ); } 
    //public function allowedActions() { return 'createQuick,create';}


       
    public function actionFileupload($id) {
            $files = new XUploadForm;
            $model = $this->loadModel($id);
            
            
            if (isset($_POST['Page'])) {
//                $model->setAttributes($_POST['Page']);
                                
                    $committed=false;
                    $transaction = Yii::app()->db->beginTransaction();
                    try {
                           $model->files = Documents::model()->saveDocuments('page_files', 'state_page_files', true);
                           if($model->saveWithRelated( array('files'=>array('append'=>true)))){
                                $transaction->commit();
                                $committed=true;
                           }
                    } catch (Exception $e) {
                         $transaction->rollBack();
                         Yii::app()->user->setFlash('error',  "Catalog doredilmedi");
                         $model->addError('id', $e->getMessage());
                    }
                    if($committed==true)
                    {
                         EUserFlash::setSuccessMessage('Catalog doredildi');
                         $this->redirect(array('admin'));
                    }
            }
            
            
            
            if(isset($model))
                $this->render('fileupload', array('files'=>$files,'model'=>$model));
            else
                $this->redirect (Yii::app()->user->returnUrl);
    }
    
    
    

    public function actionIndex() {
        $this->layout='//layouts/column2';
        $criteria=new CDbCriteria();
        $criteria->scopes=array("enabled");
        $criteria->compare('code', "department");


        $dataProvider= new CActiveDataProvider('Page', 
            array(
                'criteria'=>$criteria,
                'pagination' => false
          ));
        
        $this->render('index', array(
                'dataProvider' => $dataProvider,
        ));
    }
        
    public function actionView($id) {
        $this->layout='//layouts/column2';

        $this->render('view', array(
                'model' => $this->loadModel($id),
        ));
    }
        
    
    public function actionCreate() {
        $model = new Page;
        $photos = new XUploadForm;
        $model->reloadTempList();

        
        $descriptions=array();
        $languages=  Language::model()->findAllByAttributes(array('status'=>1));
        foreach ($languages as $language) {
            $descriptionModel=new PageDescription();
            $descriptionModel->language_id=$language->id;
            $descriptions[$language->id]=$descriptionModel;
        }
                    
            
        if (isset($_POST['Page']) && isset($_POST['PageDescription'])) {
                $model->setAttributes($_POST['Page']);
                $model->descriptions = $_POST['PageDescription'];
                $model->documents = Documents::model()->saveDocuments('page', $model->state_name, true);
                
                try {
                    $committed=false;
                    $transaction = Yii::app()->db->beginTransaction();
                        if($model->saveWithRelated( array('descriptions','documents'=>array('append' => true)))){
                            $transaction->commit();
                            $committed=true;
                        }else
                            $descriptions=$model->descriptions;
                } catch (Exception $e) {
                    $transaction->rollBack();
                    Yii::app()->user->setFlash('error',  "Page doredilmedi");
                    $model->addError('id', $e->getMessage());
                }

                if($committed==true)
                {
                     EUserFlash::setSuccessMessage('Doredildi');
                     if (isset($_GET['returnUrl'])) {
                            $this->redirect($_GET['returnUrl']);
                    } else {
                            $this->redirect(array('admin'));
                    }
                }
        } 

        $this->render('create',array(
			'model'=>$model,
                        'descriptions'=>$descriptions,
                        'photos'=>$photos,
        ));
    }

    
    
    
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $photos = new XUploadForm;
        $model->reloadTempList();
        $model->reloadDocumentsList();
        
        if( Yii::app( )->user->hasState($state_name) ) {
            $documents = Yii::app( )->user->getState($state_name);
            foreach ($documents as $docs) {
                if(is_file($docs['path'])){
                    $model->docs[]=$docs;
                }
            }
           
            if(isset($model->docs) && is_array($model->docs) && count($model->docs)>0){
                Yii::app()->user->setState( $state_name, $model->docs );
            }
        }
                
            
        $descriptions=array();
        $languages=  Language::model()->findAllByAttributes(array('status'=>1));
        foreach ($languages as $language) {
            $descriptionModel=  PageDescription::model()->findByAttributes(array('language_id'=>$language->id,'page_id'=>$model->id));
            if(isset ($descriptionModel))
                $descriptions[$language->id]=$descriptionModel;
            else{
                $descriptionModel=new PageDescription();
                $descriptionModel->language_id=$language->id;
                $descriptions[$language->id]=$descriptionModel;
            }
        }
        
        
        if (isset($_POST['Page']) && isset($_POST['PageDescription'])) {
                $model->setAttributes($_POST['Page']);
                $model->descriptions = $_POST['PageDescription'];
                                
                    $committed=false;
                    $transaction = Yii::app()->db->beginTransaction();
                    try {
                        $model->documents = Documents::model()->saveDocuments('page', $model->state_name, true);
                        if($model->saveWithRelated( array('descriptions','documents'=>array('append'=>true)))){
                             $transaction->commit();
                             $committed=true;
                        }else
                             $descriptions=$model->descriptions;
                    } catch (Exception $e) {
                         $transaction->rollBack();
                         Yii::app()->user->setFlash('error',  "Page doredilmedi");
                         $model->addError('id', $e->getMessage());
                    }
                    if($committed==true)
                    {
                         EUserFlash::setSuccessMessage('Page doredildi');
                         $this->redirect(array('admin'));
                    }
            }

            $this->render('update',array(
                    'model'=>$model,
                    'descriptions'=>$descriptions,
                    'photos'=>$photos,
            ));
    }
                
               

    public function actionDelete($id) {
        if(Yii::app()->request->isPostRequest) {    
            try {
                PageDescription::model()->deleteAllByAttributes(array('page_id'=>$id));
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
        $model = new Page('search');
        $model->unsetAttributes();

        if (isset($_GET['Page']))
                $model->setAttributes($_GET['Page']);

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
            $model=Page::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,Yii::t('app', 'The requested page does not exist.'));
            return $model;
    }

}