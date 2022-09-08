<?php

require_once( __DIR__ . '/../predis/autoload.php');
Predis\Autoloader::register();

class WorkController extends Controller {
    public $layout = '//layouts/column2_admin';


    public function filters() {
        return array('rights - cron');
    }

    //public function allowedActions() { return 'createQuick,create';}

    public function actionCron() {
        echo "</br>CRON ESATE BEGIN";
        $criteria = new CDbCriteria;
        $criteria->addCondition('date_added < DATE_ADD(NOW(), INTERVAL -12 MONTH)');
//        $criteria->addCondition('date_end < NOW()');
        $rownum = Work::model()->updateAll(array('status' => 0), $criteria);
        echo "</br>Total updated " . $rownum . ' cloumns';
        echo "</br>CRON ESATE END";


        echo "</br>CRON OLDER WORK DELETE BEGIN";
        $criteria = new CDbCriteria;
        $criteria->limit = 500;
        $criteria->addCondition('status=0 OR phone is null');
        $works = Work::model()->findAll($criteria);
        $rownum = 0;
        foreach ($works as $workModel) {
            $workModel->delete();
            $rownum++;
        }
        echo "</br>Total deleted " . $rownum . ' cloumns';
        echo "</br>CRON AUTO END";
    }


    public function actionIndex($path = null, $category_id = null) {
        $this->layout = '//layouts/column2';
        $modelWork = new Work();
        $modelWork->unsetAttributes();


        if (isset($category_id)) {
            $modelCategory = Category::model()->findByPk($category_id);
            if (Yii::app()->request->requestUri != $modelCategory->url)
                $this->redirect($modelCategory->url, true, 301);
        }
        if (isset($path) && strlen(trim($path)) > 0)
            $modelCategory = Category::model()->findByPath($path);


        if (isset ($_GET['profession_id'])) {
            $modelWork->profession_id = $_GET['profession_id'];
            if (!isset($modelCategory))
                $modelCategory = Category::model()->no_parent()->findByAttributes(array('code' => 'work'));
        }

        if (isset($modelCategory))
            $this->setMetaFromCategory($modelCategory);
        else {
            $path_tr = Category::model()->translatePath($path);
            $modelCategory = Category::model()->findByPath($path_tr);
            if (isset($modelCategory))
                $this->redirect($modelCategory->url, true);
            throw new CHttpException(404, 'Not found');
        }


        if (isset($modelCategory) && isset($modelCategory->parent_id) && $modelCategory->parent_id > 0)
            $modelWork->category_id = $modelCategory->id;

        if (isset ($_GET['Work']))
            $modelWork->setAttributes($_GET['Work'], false);


        $this->render('//work/index', array(
            'modelWork' => $modelWork,
            'modelCategory' => $modelCategory,
        ));
    }


    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->layout = '//layouts/column2';
        if (isset ($_GET['ajax']) && $_GET['ajax'] == 'comments_listview') {
            $this->renderPartial('//comments/listview', array('related_relation' => 'works', 'related_relation_id' => $id));
        } else {
            $model = $this->loadModel($id);
            $url = $model->getUrl();
            Yii::app()->clientScript->registerLinkTag('canonical', null, $url);
            if (strpos(Yii::app()->request->url, 'index.php') !== false)
                $this->redirect($url, true, 301);

            //Redis
//            $client = new Predis\Client();

//            if (!$client->exists('view_count_work_' . $id))
//                $client->set('view_count_work_' . $id, 0);

//            $client->incr('view_count_work_' . $id);
            $model->saveCounters(array('views' => 1));

            $this->render('view', array(
                'model' => $model,
            ));
        }
//        $this->layout='//layouts/column2';
//        $this->render('view', array(
//            'model' => $this->loadModel($id),
//        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Work;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Work'])) {
            $model->attributes = $_POST['Work'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Work'])) {
            $model->attributes = $_POST['Work'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
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


    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Work('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Work']))
            $model->attributes = $_GET['Work'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Work the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Work::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Work $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'work-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}

?>