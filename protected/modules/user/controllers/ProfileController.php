<?php

class ProfileController extends Controller {
    public $defaultAction = 'profile';
//	public $layout='//layouts/column2_admin';
    public $layout = '//layouts/user_profile';

    public function filters() {
        return array('rights',);
    }


    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    private $_model;

    /**
     * Shows a particular model.
     */
    public function actionProfile() {
//        $this->layout = '//layouts/column_obyawa';
        $model = $this->loadUser();


        $serviceModel = Service::model()->findAllByAttributes(array(
            'user_id' => $model->id
        ));
        $services = array();
        foreach ($serviceModel as $row) {
            $services[] = $row->service_name;
        }

        $this->render('profile', array(
            'model' => $model,
            'profile' => $model->profile,
            'services' => $services,
        ));
    }


    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     */
    public function actionEdit() {
        $model = $this->loadUser();
        $profile = $model->profile;
        $photos = new XUploadForm;

        if (!isset($profile)) {
            $profile = new Profile();
            $profile->user_id = $model->getPrimaryKey();
        }

        // ajax validator
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'profile-form') {
            echo UActiveForm::validate(array($model, $profile));
            Yii::app()->end();
        }

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            $profile->attributes = $_POST['Profile'];
            $model->documents = Documents::model()->saveDocuments('users', 'state_user', true);

            if ($model->validate() && $profile->validate()) {
                $model->saveWithRelated('documents');
                $profile->save();
                Yii::app()->user->updateSession();
                Yii::app()->user->setFlash('profileMessage', UserModule::t("Changes is saved."));
                $this->redirect(array('/user/profile'));
            } else $profile->validate();
        }

        $this->render('edit', array(
            'model' => $model,
            'photos' => $photos,
            'profile' => $profile,
        ));
    }


    /**
     * Change password
     */
    public function actionChangepassword() {
        $model = new UserChangePassword;
        if (Yii::app()->user->id) {
            // ajax validator
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'changepassword-form') {
                echo UActiveForm::validate($model);
                Yii::app()->end();
            }

            if (isset($_POST['UserChangePassword'])) {
                $model->attributes = $_POST['UserChangePassword'];
                if ($model->validate()) {
                    $new_password = User::model()->notsafe()->findbyPk(Yii::app()->user->id);
                    $new_password->password = UserModule::encrypting($model->password);
                    $new_password->activkey = UserModule::encrypting(microtime() . $model->password);
                    $new_password->save();
                    Yii::app()->user->setFlash('profileMessage', UserModule::t("New password is saved."));
                    $this->redirect(array("profile"));
                }
            }
            $this->render('changepassword', array('model' => $model));
        }
    }


    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the primary key value. Defaults to null, meaning using the 'id' GET variable
     */
    public function loadUser() {
        if ($this->_model === null) {
            if (Yii::app()->user->id)
                $this->_model = Yii::app()->controller->module->user();
            if ($this->_model === null)
                $this->redirect(Yii::app()->controller->module->loginUrl);
        }
        return $this->_model;
    }


    public function actionComments() {
        $this->layout = '//layouts/user_profile';
        $userModel = $this->loadUser();
        $commentsModel = new Comments();
        $commentsModel->unsetAttributes();
        $commentsModel->create_username = $userModel->username;

        $this->render('comments', array(
            'commentsModel' => $commentsModel,
        ));
    }


    public function actionBanners() {
        $this->layout = '//layouts/user_profile';
        $userModel = $this->loadUser();
        $bannerModel = new Banner();
        $bannerModel->unsetAttributes();
        $bannerModel->related_user_id = $userModel->id;

        $this->render('banners', array(
            'model' => $bannerModel,
        ));
    }


    /* ?????????? ?????? ???????????????? ???????????? ???? ?????????????? tbl_service */
    public function actionDeleteService() {
        $service = Service::model()->findByAttributes(array(
            'service_name' => Yii::app()->request->getQuery('service'),
            'user_id' => Yii::app()->user->id,
        ));
        $service->delete();
        $this->redirect(array('/user/profile'));
    }
}