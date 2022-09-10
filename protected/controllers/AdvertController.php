<?php

require_once( __DIR__ . '/../predis/autoload.php');
Predis\Autoloader::register();

class AdvertController extends Controller {

    public $layout='//layouts/column2_admin';

    public function filters() { return array( 'rights', ); }
    //public function allowedActions() { return 'createQuick,create';}

    public function actionIndex($path=null, $category_id=null){
        $this->layout='//layouts/column2';

        if(isset($category_id)){
            $modelCategory = Category::model()->findByPk($category_id);
            if (Yii::app()->request->requestUri != $modelCategory->url)
                $this->redirect($modelCategory->url, true, 301);
        }

        if(isset($path) && strlen(trim($path))>0)
            $modelCategory = Category::model()->findByPath($path);
        if(isset($modelCategory))
            $this->setMetaFromCategory($modelCategory);

        $modelAdvert = new Advert('search');
        $modelAdvert->unsetAttributes();
        if (isset($_GET['Advert'])){
            $modelAdvert->setAttributes($_GET['Advert']);
        }

        if(isset($modelCategory->parent_id) && $modelCategory->parent_id>0){
            $modelAdvert->category_id=$modelCategory->id;
        }else{
            $modelAdvert->parent_category_id=$modelCategory->parent_id;
        }

        $this->setMetaFromCategory($modelCategory);
        $this->render('index', array(
            'modelCategory' => $modelCategory,
            'modelAdvert' => $modelAdvert,
        ));
    }

    public function actionView($id) {
        $this->layout='//layouts/column2';
        if(isset ($_GET['ajax']) && $_GET['ajax']=='comments_listview'){
           $this->renderPartial('//comments/listview',array('related_relation' => 'adverts','related_relation_id'=>$id));
        }  else {
            $model=  $this->loadModel($id);
            if ($model === null || $model->status!=1)
                throw new CHttpException(404, 'Not found');
            $url=$model->getUrl();
            Yii::app()->clientScript->registerLinkTag('canonical', null, $url);
            if(strpos(Yii::app()->request->url, 'index.php')!==false)
                $this->redirect($url, true, 301);

            //Redis
            $client = new Predis\Client();

            if (!$client->exists('view_count_advert_' . $id))
                $client->set('view_count_advert_' . $id, 0);

//            $client->incr('view_count_advert_' . $id);
            $model->saveCounters(array('views'=>1));

//            $model->views += $client->get('view_count_advert_' . $id);

            $this->render('view', array(
                    'model' =>  $model,
            ));
        }
    }
    
    
    public function actionCreate() {
        $photos = new XUploadForm;
        $model = new Advert;
            
        if (isset($_POST['Advert'])) {
                $model->setAttributes($_POST['Advert']);
                    try {
                        $committed=false;
                        $transaction = Yii::app()->db->beginTransaction();
                        $model->documents = Documents::model()->saveDocuments('advert', 'state_advert', true);
                           if($model->saveWithRelated( array('documents'=>array('append' => true)))){
                                $transaction->commit();
                                $committed=true;
                           }
                    } catch (Exception $e) {
                        $transaction->rollBack();
                        Yii::app()->user->setFlash('error',  "Advert doredilmedi");
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
            $model->advert_category_id=$model->category->parent_id;
        
        if (isset($_POST['Advert'])) {
                $model->setAttributes($_POST['Advert']);
                                
                    $committed=false;
                    $transaction = Yii::app()->db->beginTransaction();
                    try {
                        $model->documents = Documents::model()->saveDocuments('advert', 'state_advert', true);
                        if($model->saveWithRelated( array('documents'=>array('append'=>true)))){
                                $transaction->commit();
                                $committed=true;
                           }
                    } catch (Exception $e) {
                         $transaction->rollBack();
                         Yii::app()->user->setFlash('error',  "Advert uytgedilmedi");
                         $model->addError('id', $e->getMessage());
                    }
                    if($committed==true)
                    {
                         EUserFlash::setSuccessMessage('Advert uytgedilmedi');
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
            
            
            if (isset($_POST['Advert'])) {
                $model->setAttributes($_POST['Advert']);
                                
                    $committed=false;
                    $transaction = Yii::app()->db->beginTransaction();
                    try {
                           $model->files = Documents::model()->saveDocuments('advert_files', 'state_advert_files', true);
                           if($model->saveWithRelated( array('files'=>array('append'=>true)))){
                                $transaction->commit();
                                $committed=true;
                           }
                    } catch (Exception $e) {
                         $transaction->rollBack();
                         Yii::app()->user->setFlash('error',  "Advert doredilmedi");
                         $model->addError('id', $e->getMessage());
                    }
                    if($committed==true)
                    {
                         EUserFlash::setSuccessMessage('Advert doredildi');
                         $this->redirect(array('admin'));
                    }
            }
            
            
            
            if(isset($model))
                $this->render('//advert/fileupload', array('files'=>$files,'model'=>$model));
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
        $model = new Advert('search');
        $model->unsetAttributes();

        if (isset($_GET['Advert']))
                $model->setAttributes($_GET['Advert']);

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
            $model=Advert::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,Yii::t('app', 'The requested page does not exist.'));
            return $model;
    }

    

    
    
}