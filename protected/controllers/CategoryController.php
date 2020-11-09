<?php
class CategoryController extends Controller {

    public $layout='//layouts/column2_admin';



    public function filters() { return array( 'rights', ); } 
    //public function allowedActions() { return 'createQuick,create';}



    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Category');
        $this->render('index', array(
                'dataProvider' => $dataProvider,
        ));
    }
        
    public function actionView($id) {
        $this->render('view', array(
                'model' => $this->loadModel($id),
        ));
    }
        
    
    public function actionAutocomplete()
    {
//       if(Yii::app()->request->isAjaxRequest && isset($_GET['q']) && strlen(trim( $_GET['q'] ))>1)
//       {
          $name = $_GET['q']; 
          $limit = min($_GET['limit'], 50); 
          $criteria = new CDbCriteria;
          $criteria->addSearchCondition('name_'.Yii::app()->language,'%'.$name.'%',false);
          $criteria->limit = $limit;
          $categories = Category::model()->findAll($criteria);
          $returnVal = '';
          foreach($categories as $category)
          {
             $parentsString=$category->getParentInheritance(true);
             $returnVal .= $parentsString.'|'.$category->getAttribute('id')."\n";
          }
          echo $returnVal;
//       }
    }
    

    
    

    public function actionCreate() {
        $model = new Category;
        $model->reloadTempList();
        $photos = new XUploadForm;
            
        if (isset($_POST['Category'])) {
                $model->setAttributes($_POST['Category']);
                $model->documents = Documents::model()->saveDocuments('category', $model->state_name, true);

                    if (strlen(trim($_POST['parent_auto_complete']))==0) 
                        $model->parent_id="";
                
                    try {
                        $committed=false;
                        $transaction = Yii::app()->db->beginTransaction();
                           if($model->saveWithRelated( array('parent','documents'))){
                                $transaction->commit();
                                $committed=true;
                           }
                    } catch (Exception $e) {
                        $transaction->rollBack();
                        Yii::app()->user->setFlash('error',  "Category doredilmedi");
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
			'photos'=>$photos,
        ));
    }

    public function actionUpdateAll() {
        $catgories=Category::model()->findAll();
        foreach ($catgories as $cat){
            $cat->save();
        }
    }
    
    
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model->reloadTempList();
        $model->reloadDocumentsList();
        $photos = new XUploadForm;
        
        
        if (isset($_POST['Category'])) {

                $model->setAttributes($_POST['Category']);
                $model->documents = Documents::model()->saveDocuments('category', $model->state_name, true);
                if (strlen(trim($_POST['parent_auto_complete']))==0) 
                    $model->parent_id="";
                    $committed=false;
                    $transaction = Yii::app()->db->beginTransaction();
                    try {
                           if($model->saveWithRelated(array('parent','documents'=>array('append' => true)))){
                                $transaction->commit();
                                $committed=true;
                           }
                    } catch (Exception $e) {
                         $transaction->rollBack();
                         Yii::app()->user->setFlash('error',  "Category doredilmedi");
                         $model->addError('id', $e->getMessage());
                    }
                    
                    if($committed==true)
                    {
                         EUserFlash::setSuccessMessage('Category doredildi');
                         $this->redirect(array('admin'));
                    }
            }

            $this->render('update',array(
                    'model'=>$model,
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
        $model = new Category('search');
        $model->unsetAttributes();

        if (isset($_GET['Category']))
                $model->attributes=$_GET['Category'];

       
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
            $model=Category::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,Yii::t('app', 'The requested page does not exist.'));
            return $model;
    }
    
    
    
    public function actionDynamicSubCategories()
    {
        $catalog_category_id=$_POST['Catalog']['catalog_category_id'];
        if(!isset($catalog_category_id))
            $catalog_category_id=$_POST['Compositions']['parent_category_id'];
        if(!isset($catalog_category_id))
            $catalog_category_id=$_POST['Blog']['parent_category_id'];

        if(isset ($catalog_category_id)){
            
            $data= Category::model()->sort_by_alpha()->enabled()->findAllByAttributes(array('parent_id'=>$catalog_category_id));

            $data=CHtml::listData($data,'id','name_'.Yii::app()->language);

            foreach($data as $value=>$name)
            {
                echo CHtml::tag('option',
                           array('value'=>$value),CHtml::encode($name),true);
            }
        }
    }
    
    
    
    public function actionDynamicForms()
    {
        $catalog_category_id=$_POST['Catalog']['catalog_category_id'];
        
         if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
//                 Yii::app()->clientScript->scriptMap['jquery.js'] = false;
//                 Yii::app()->clientScript->scriptMap['jquery-ui.min.js'] = false;
//                 Yii::app()->clientScript->scriptMap['jquery.yiiactiveform.js'] = false;
//                 Yii::app()->clientScript->scriptMap['jquery-ui-timepicker-addon.js'] = false;
//                 Yii::app()->clientScript->scriptMap['jquery.yiigridview.js'] = false;
//                 Yii::app()->clientScript->scriptMap['jquery-ui.min.js'] = false;
//                 Yii::app()->clientScript->scriptMap['jquery-ui-i18n.min.js'] = false;
//                 Yii::app()->clientScript->scriptMap['jquery.yiiactiveform.js'] = false;
//                 Yii::app()->clientScript->scriptMap['jquery.autocomplete.js'] = false;
//                 Yii::app()->clientScript->scriptMap['jquery.ba-bbq.js'] = false;
//                 Yii::app()->clientScript->scriptMap['jquery.fileupload-fp.js'] = false;
//                 Yii::app()->clientScript->scriptMap['jquery.fileupload-ip.js'] = false;
//                 Yii::app()->clientScript->scriptMap['jquery.fileupload-ui.js'] = false;
//                 Yii::app()->clientScript->scriptMap['jquery.fileupload.js'] = false;
//                 Yii::app()->clientScript->scriptMap['jquery.iframe-transport.js'] = false;
//                 Yii::app()->clientScript->scriptMap['load-image.min.js'] = false;
//                 Yii::app()->clientScript->scriptMap['spinner.js'] = false;
        }
        
        
        if( isset($catalog_category_id)){
            
            $categoryModel= Category::model()->findByPk($catalog_category_id);
            $data_id=$_GET['data_id'];
            
            if(isset($categoryModel)){
                switch($catalog_category_id){
//                    case 116:
//                        $model = new Employees();
//                        $model->status=Employees::STATUS_ENABLED;
//                        $descriptionModel = new EmployeesDescription();
//                        $descriptionModel->language_id=Yii::app()->session['current_lang_id'];
//                        $this->renderPartial('//employees/_form', array(
//                            'model' => $model,
//                            'descriptionModel' => $descriptionModel),
//                            false,
//                            true
//                        );
//                    break;
//
//                    case 117:
//                        $model = new Employers();
//                        $model->status=Employers::STATUS_ENABLED;
//                        $descriptionModel = new EmployersDescription();
//                        $descriptionModel->language_id=Yii::app()->session['current_lang_id'];
//                        $this->renderPartial('//employers/_form', array(
//                            'model' => $model,
//                            'descriptionModel' => $descriptionModel),
//                            false,
//                            true
//                        );
//                    break;
//
                    case 286:
                        $model = new Auto();
                        $photos = new XUploadForm;
                        $model->status=Auto::STATUS_ENABLED;
                        $model->catalog_category_id= $catalog_category_id;
                        $descriptionModel = new AutoDescription();
                        $descriptionModel->language_id=Yii::app()->session['current_lang_id'];
                        $this->renderPartial('//auto/_form', array(
                            'model' => $model,
                            'photos' => $photos,
                            'descriptionModel' => $descriptionModel), 
                            false, 
                            true
                        );
                    break;
                    
                    case 288: 
//                        if($data_id)
//                            $model = Estates::model()->findByPk($data_id);
//                        else
                            $model = new Estates();
                        $photos = new XUploadForm;
                        $model->status=Estates::STATUS_ENABLED;
                        $model->catalog_category_id= $catalog_category_id;
                        $descriptionModel = new EstatesDescription();
                        $descriptionModel->language_id=Yii::app()->session['current_lang_id'];
                        $this->renderPartial('//estates/_form', array(
                            'model' => $model,
                            'photos' => $photos,
                            'descriptionModel' => $descriptionModel), 
                            false, 
                            true
                        );
                    break;
                
                    default:
                        $model = new Catalog();
                        $photos = new XUploadForm;
                        $model->status=  Catalog::STATUS_DISABLED;
                        $model->catalog_category_id= $catalog_category_id;
//                        $descriptionModel = new CatalogDescription();
//                        $descriptionModel->language_id=Yii::app()->session['current_lang_id'];
                        $this->renderPartial('//catalog/_form', array(
                            'model' => $model,
                            'photos' => $photos,
//                            'descriptionModel' => $descriptionModel
                            ), 
                            false, 
                            true
                        );
                }
            }
        }
    }
    
    
    
    
    
    public function actionCategory($category_id=null){
        $this->layout='//layouts/column2';
        
        if(isset($category_id))
            $modelCategory = Category::model()->findByPk($category_id);
        else
            $modelCategory = Category::model()->no_parent()->findByAttributes(array('code'=>'work'));
        
        $modelEmployees = new Employees('search');
        $modelEmployers = new Employers('search');
        
      
        $this->setMetaFromCategory($modelCategory);
        $this->render('frontend_page', array(
                'modelCategory' => $modelCategory,
                'modelEmployees' => $modelEmployees,
                'modelEmployers' => $modelEmployers,
        ));
    }
    
}