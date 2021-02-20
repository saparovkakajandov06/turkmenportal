<?php

class CommentsController extends Controller
{

    public $layout = '//layouts/column2_admin';


    public function filters()
    {
        return array('rights',);
    }

    //public function allowedActions() { return 'createQuick,create';}


    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Comments');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

//    
//    public function actionUsers($username) {
////        $this->layout = '//layouts/column1';
//        $this->layout = '//layouts/user_profile';
//
//        $commentsModel=new Comments();
//        $commentsModel->unsetAttributes();
//        $commentsModel->create_username=$username;
//        
//        if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
//            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
//            $this->renderPartial('//comments/users', array(
//                    'commentsModel' => $commentsModel,
//            ),false, true);
//        }else{
//            $this->render('//comments/users', array(
//                    'commentsModel' => $commentsModel,
//            ));
//        }
//    }
//        

    public function actionListView()
    {
        $dataProvider = new CActiveDataProvider('Comments');
        $this->render('//comments/listview', array(
            'dataProvider' => $dataProvider,
        ));
    }


    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }


    public function actionCreatet($related_relation = null, $related_relation_id = null, $parent_id = null)
    {
        $model = new Comments;
        if (isset ($related_relation) && isset ($related_relation_id)) {
            $model->related_relation = $related_relation;
            $model->related_relation_id = $related_relation_id;
        }
        if (isset ($parent_id))
            $model->parent_id = $parent_id;
        $model->status = 1;


        $this->performAjaxValidation($model);
        $flag = true;
        if (isset($_POST['Comments'])) {
            $flag = false;
            $model->attributes = $_POST['Comments'];
            $ip = $this->getRealIp();
            $model->ip_added = $model->ip_modified = $ip;
            try {
                $committed = false;
                if (isset ($model->related_relation) && isset ($model->related_relation_id) && strlen(trim($model->related_relation)) > 0) {
                    $transaction = Yii::app()->db->beginTransaction();
                    $relations = $model->relations();
                    if (isset($relations) && isset($relations[$model->related_relation][1]))
                        $model->related_to = $relations[$model->related_relation][1];

                    $relation_name = $model->related_relation;
                    $model->$relation_name = array($model->related_relation_id);
                    if ($model->saveWithRelated(array($relation_name => array('append' => true)))) {
                        $transaction->commit();
                        $committed = true;
                    }
                } else if ($model->parent_id) {
                    if ($model->save())
                        $committed = true;
                }
            } catch (Exception $e) {
                $transaction->rollBack();
                Yii::app()->user->setFlash('error', "Comment doredilmedi" . $e->getMessage());
                $model->addError('id', $e->getMessage());
            }

            if ($committed == true) {
                $related = CActiveRecord::model($model->related_to)->findByPk($model->related_relation_id);
                if (isset($related)) {
                    $to = Yii::app()->params['adminAlertEmail'];
                    $subject = Yii::app()->controller->truncate($model->getTitle(), 10, 50) . ' ( Comment doredildi )';
                    $this->sendTemplateEmail($to, $subject, 'comments/view', array('model' => $model, 'related' => $related));
                }

                echo CJSON::encode(array(
                    'status' => 'success',
                    'message' => "Comment doredildi",
                ));
            } else {
                echo CJSON::encode(array(
                    'status' => 'error',
                    'message' => "Comment doredilmedi",
                ));
            }
        }

        if ($flag) {
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            $this->renderPartial('//comments/_form', array('model' => $model), false, true);
        }
    }


    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'comments-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }


    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['Comments'])) {
            $model->setAttributes($_POST['Comments']);
            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('view', 'id' => $model->id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('id', $e->getMessage());
            }

        }

        $this->render('update', array(
            'model' => $model,
        ));
    }


    public function actionDelete($id = null)
    {
        if (Yii::app()->request->isPostRequest && $id != null) {
            try {
                $this->loadModel($id)->delete();
            } catch (Exception $e) {
                throw new CHttpException(500, $e->getMessage());
            }

            if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
                $this->redirect(array('admin'));
            }
        } elseif (isset ($_GET['mail_delete']) && $_GET['mail_delete'] == 1) {
            $this->loadModel($_GET['id'])->delete();
            echo "Bah pozaydynmay commentimi beytmeda how nahilay sen bolanda name admin :)))) </br>";
            echo CHtml::link('www.Turkmenportal.com', Yii::app()->createUrl('//site/index'));
        } else
            throw new CHttpException(400,
                Yii::t('app', 'Invalid request.'));
    }


    public function actionAdmin()
    {
        $model = new Comments('search');
        $model->unsetAttributes();
        $model->default_scope = array('sort_newest');

        if (!isset($_GET['Comments_sort']))
            $_GET['Comments_sort'] = 'date_added.desc';

        if (isset($_GET['Comments']))
            $model->setAttributes($_GET['Comments']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }


    public function actionToggle($id, $attribute, $model)
    {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $model = $this->loadModel($id, $model);
            //loadModel($id, $model) from giix
            ($model->$attribute == 1) ? $model->$attribute = 0 : $model->$attribute = 1;
            $model->save();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }


    public function actionLike($id)
    {
        if (Yii::app()->request->isAjaxRequest) {
            $model = $this->loadModel($id);
            if ($model->saveCounters(array('like_count' => 1))) {
                echo CJSON::encode(array(
                    'status' => 'success',
                    'message' => Yii::t('app', 'comment_like_success'),
                ));
            }
        } else
            echo CJSON::encode(array(
                'status' => 'error',
                'message' => Yii::t('app', 'comment_like_error'),
            ));
    }


    public function actionDislike($id)
    {
        if (Yii::app()->request->isAjaxRequest) {
            $model = $this->loadModel($id);
            if ($model->saveCounters(array('dislike_count' => 1))) {
                echo CJSON::encode(array(
                    'status' => 'success',
                    'message' => Yii::t('app', 'comment_dislike_success'),
                ));
            }
        } else
            echo CJSON::encode(array(
                'status' => 'error',
                'message' => Yii::t('app', 'comment_dislike_error'),
            ));
    }


    public function loadModel($id)
    {
        $model = Comments::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        return $model;
    }

}