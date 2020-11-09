<?php
class AutoModelsController extends Controller {

    public $layout='//layouts/column2_admin';



    public function filters() { return array( 'rights', ); } 
    //public function allowedActions() { return 'createQuick,create';}



    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('AutoModels');
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
        $model = new AutoModels;
                if (isset($_POST['AutoModels'])) {
            $model->setAttributes($_POST['AutoModels']);

                
                try {
                    if($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                            $this->redirect($_GET['returnUrl']);
                    } else {
                            $this->redirect(array('view','id'=>$model->id));
                    }
                }
                } catch (Exception $e) {
                        $model->addError('', $e->getMessage());
                }
        } elseif(isset($_GET['AutoModels'])) {
                        $model->attributes = $_GET['AutoModels'];
        }

        $this->render('create',array( 'model'=>$model));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        
        if(isset($_POST['AutoModels'])) {
            $model->setAttributes($_POST['AutoModels']);
                try {
                    if($model->save()) {
                        if (isset($_GET['returnUrl'])) {
                                $this->redirect($_GET['returnUrl']);
                        } else {
                                $this->redirect(array('view','id'=>$model->id));
                        }
                    }
                } catch (Exception $e) {
                        $model->addError('', $e->getMessage());
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
        $model = new AutoModels('search');
        $model->unsetAttributes();

        if (isset($_GET['AutoModels']))
                $model->setAttributes($_GET['AutoModels']);

        $this->render('admin', array(
                'model' => $model,
        ));
    }
    
    
    public function loadModel($id) {
            $model=AutoModels::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,Yii::t('app', 'The requested page does not exist.'));
            return $model;
    }

    
    
    public function actionDynamicModels()
    {
        $make_id=$_POST['Auto']['make_id'];
        if(isset ($make_id)){
            $data= AutoModels::model()->findAllByAttributes(array('make_id'=>$make_id),array('order'=>'name'));
            $data=CHtml::listData($data,'id','name');
            if(isset($data) && count($data)>0){
                echo CHtml::tag('option',array('value'=>''),"--".Yii::t('app', 'model_id')."--",true);
                foreach($data as $value=>$name)
                {
                    echo CHtml::tag('option',array('value'=>$value),CHtml::encode($name),true);
                }
            }
        }
    }
}