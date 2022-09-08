<?php

require_once( __DIR__ . '/../predis/autoload.php');
Predis\Autoloader::register();

class ObyavaController extends Controller {

    public $layout='//layouts/column2_admin';



    public function filters() { return array( 'rights', ); } 
    //public function allowedActions() { return 'createQuick,create';}



    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Catalog');
        $this->render('index', array(
                'dataProvider' => $dataProvider,
        ));
    }
        
    public function actionView($id) {
        $this->layout='//layouts/column2';
        if(isset ($_GET['ajax']) && $_GET['ajax']=='comments_listview'){
           $this->renderPartial('//comments/listview',array('related_relation' => 'catalogs','related_relation_id'=>$id));
        }  else {
            $model=  $this->loadModel($id);   
            $url=$model->getUrl();
            Yii::app()->clientScript->registerLinkTag('canonical', null, $url);
            if(strpos(Yii::app()->request->url, 'index.php')!==false)
                $this->redirect($url, true, 301);

            //Redis
//            $client = new Predis\Client();

//            if (!$client->exists('view_count_catalog_' . $id))
//                $client->set('view_count_catalog_' . $id, 0);

//            $client->incr('view_count_catalog_' . $id);
            $model->saveCounters(array('views'=>1));

            $this->render('view', array(
                    'model' =>$model,
            ));
        }
    }
    
    
    public function actionCreate() {
        $photos = new XUploadForm;
        $model = new Catalog;
            
        if (isset($_POST['Catalog'])) {
                $model->setAttributes($_POST['Catalog']);
                    try {
                        $committed=false;
                        $transaction = Yii::app()->db->beginTransaction();
                        $model->documents = Documents::model()->saveDocuments('catalog', 'state_catalog', true);
                           if($model->saveWithRelated( array('documents'=>array('append' => true)))){
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
                         EUserFlash::setSuccessMessage('Doredildi');
                         if (isset($_GET['returnUrl'])) {
                                $this->redirect($_GET['returnUrl']);
                        } else {
                                $this->redirect(array('admin'));
//                                $this->redirect(array('view','id'=>$model->id));
                        }
                    }
        } 

        
        $this->render('create',array(
			'model'=>$model,
                        'photos'=>$photos,
        ));
    }

    
    
  
        
    
    
    
    public function actionUpdate($id) {
        $photos = new XUploadForm;
        $model = $this->loadModel($id);
        if(isset($model->category))
            $model->catalog_category_id=$model->category->parent_id;
        
        if (isset($_POST['Catalog'])) {
                $model->setAttributes($_POST['Catalog']);
                                
                    $committed=false;
                    $transaction = Yii::app()->db->beginTransaction();
                    try {
                        $model->documents = Documents::model()->saveDocuments('catalog', 'state_catalog', true);
                        if($model->saveWithRelated( array('documents'=>array('append'=>true)))){
                                $transaction->commit();
                                $committed=true;
                           }
                    } catch (Exception $e) {
                         $transaction->rollBack();
                         Yii::app()->user->setFlash('error',  "Catalog uytgedilmedi");
                         $model->addError('id', $e->getMessage());
                    }
                    if($committed==true)
                    {
                         EUserFlash::setSuccessMessage('Catalog uytgedilmedi');
                         $this->redirect(array('admin'));
                    }
            }

            $this->render('update',array(
                    'model'=>$model,
                    'photos'=>$photos,
            ));
    }
                
        
    
    
        
    public function actionFileupload($id) {
            $files = new XUploadForm;
            $model = $this->loadModel($id);
            
            
            if (isset($_POST['Catalog'])) {
                $model->setAttributes($_POST['Catalog']);
                                
                    $committed=false;
                    $transaction = Yii::app()->db->beginTransaction();
                    try {
                           $model->files = Documents::model()->saveDocuments('catalog_files', 'state_catalog_files', true);
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
                $this->render('//catalog/fileupload', array('files'=>$files,'model'=>$model));
            else
                $this->redirect (Yii::app()->user->returnUrl);
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
        $model = new Catalog('search');
        $model->unsetAttributes();

        if (isset($_GET['Catalog']))
                $model->setAttributes($_GET['Catalog']);

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
            $model=Catalog::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,Yii::t('app', 'The requested page does not exist.'));
            return $model;
    }

    
    
    
    
    
    public function actionGeneralCreate($category_id=null) { 
        
            $photos = new XUploadForm;
            $model = new Catalog();
            $model->catalog_category_id=$category_id;
            $model->status=Catalog::STATUS_DISABLED;
//            $descriptionModel = new CatalogDescription();
//            $descriptionModel->language_id=Yii::app()->session['current_lang_id'];
            
            
//            $this->layout = '//layouts/column2';
            $this->layout="//layouts/column_obyawa";

            $flag = true;
            if (isset($_POST['Catalog']) && isset($_POST['CatalogDescription']) ) {
                $flag = false;
                $model->attributes = $_POST['Catalog'];
//                $descriptionModel->attributes=$_POST['CatalogDescription'];
//                $model->descriptions = array($descriptionModel);
     
                   try {
                        $committed = false;
                        $transaction = Yii::app()->db->beginTransaction();
                        $model->documents = Documents::model()->saveDocuments('catalog', 'state_catalog', true);
                        if ($model->saveWithRelated(array('descriptions','documents'))) {
                            $transaction->commit();
                            $committed = true;
                        }else
                            $descriptionModel=$model->descriptions[0];
                    } catch (Exception $e) {
                        echo "Message: ".$e->getMessage();
                        $transaction->rollBack();
                        Yii::app()->user->setFlash('error', "Catalog doredilmedi");
                        $model->addError('id', $e->getMessage());
                    }

                   if ($committed == true) {
                            $message="URL: ".Yii::app()->createUrl('//catalog/view',array('id'=>$model->id));
                            UserModule::sendMail(Yii::app()->params['adminEmail'],Yii::t('app','tp_obyawa_goshuldy'),$message);
                            EUserFlash::setSuccessMessage('Doredildi');
                            echo CJSON::encode(array(
                                          'status'=>'success',
                                          'redirect'=>Yii::app()->createUrl('//site/index'),
                                          'message'=>Yii::t('app','client_form_alert_message_from_admins'),
                                     ));
                            Yii::app()->end();
                    } else {
                             echo CJSON::encode(array(
                                              'status'=>'error',
                                              'message'=> CActiveForm::validate(array($model,$descriptionModel)),
                                         ));
                               Yii::app()->end();
                    }
            } 
            if($flag = true){
                $this->render('general', array('photos'=>$photos,'model' => $model), false, true);
            }
        }
        
    
    
}