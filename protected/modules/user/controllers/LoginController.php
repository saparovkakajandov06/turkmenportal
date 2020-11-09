<?php

class LoginController extends Controller {
    public $defaultAction = 'login';

    /**
     * Displays the login page
     */
    public function actionLogin() {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            $this->actionAjaxLogin();
            return;
        }

        $serviceName = Yii::app()->request->getQuery('service');
        if (isset($serviceName)) {
            $eauth = Yii::app()->eauth->getIdentity($serviceName);
            $eauth->redirectUrl = Yii::app()->user->returnUrl;
            $eauth->cancelUrl = $this->createAbsoluteUrl('user/login');

            try {
                if ($eauth->authenticate()) {
                    $identity = new ServiceUserIdentity($eauth);

                    // успешная аутентификация
                    if ($identity->authenticate()) {
                        if (Yii::app()->user->isGuest) {
                            Yii::app()->user->login($identity);
                            $eauth->redirect();
                        } else {
                            $eauth->redirectUrl = $this->createAbsoluteUrl('/user/profile');
                            $eauth->cancelUrl = $this->createAbsoluteUrl('/user/profile');

                            $service = new Service();
                            $service->identity = $eauth->id;
                            $service->service_name = $eauth->serviceName;
                            $service->user_id = Yii::app()->user->id;

                            if ($service->save()) {
                                $eauth->redirect();
                            }
                        }
                    } else {
                        // закрытие popup-окна
                        $eauth->cancel();
                    }
                }
                $this->redirect(array('user/login'));
            } catch (EAuthException $e) {
                Yii::app()->user->setFlash('error',
                    'EAuthException: ' . $e->getMessage());
                $eauth->redirect($eauth->getCancelUrl());
            }
        } elseif (Yii::app()->user->isGuest) {
            $this->layout = '//layouts/column1';
            $model = new UserLogin;
            // collect user input data
            if (isset($_POST['UserLogin'])) {
                $model->attributes = $_POST['UserLogin'];
                // validate user input and redirect to previous page if valid
                if ($model->validate()) {
                    $this->lastViset();
                    if (Yii::app()->user->returnUrl == '/index.php')
                        $this->redirect(Yii::app()->controller->module->returnUrl);
                    else
                        $this->redirect(Yii::app()->user->returnUrl);


                    //$this->redirect(Yii::app()->createUrl('//user/profile'));
                }
            }
            // display the login form
            $this->render('/user/login', array('model' => $model));
        } else
            $this->redirect(Yii::app()->controller->module->returnUrl);
    }


    public function actionAjaxLogin() {
        $model = new UserLogin;
        $model->scenario = 'ajaxLogin';
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        $serviceName = Yii::app()->request->getQuery('service');
        if (isset($serviceName)) {
            $eauth = Yii::app()->eauth->getIdentity($serviceName);
            $eauth->redirectUrl = Yii::app()->user->returnUrl;
            $eauth->cancelUrl = $this->createAbsoluteUrl('user/login');

            try {
                if ($eauth->authenticate()) {
                    $identity = new ServiceUserIdentity($eauth);

                    // успешная аутентификация
                    if ($identity->authenticate()) {
                        if (Yii::app()->user->isGuest) {
                            Yii::app()->user->login($identity);
                            $eauth->redirect();
                        } else {
                            $eauth->redirectUrl = $this->createAbsoluteUrl('/user/profile');
                            $eauth->cancelUrl = $this->createAbsoluteUrl('/user/profile');

                            $service = new Service();
                            $service->identity = $eauth->id;
                            $service->service_name = $eauth->serviceName;
                            $service->user_id = Yii::app()->user->id;

                            if ($service->save()) {
                                $eauth->redirect();
                            }
                        }
                    } else {
                        // закрытие popup-окна
                        $eauth->cancel();
                    }
                }
                $this->redirect(array('user/login'));
            } catch (EAuthException $e) {
                Yii::app()->user->setFlash('error',
                    'EAuthException: ' . $e->getMessage());
                $eauth->redirect($eauth->getCancelUrl());
            }
        } elseif (Yii::app()->user->isGuest) {
            // collect user input data
            $flag = true;
            if (isset($_POST['UserLogin'])) {
                $flag = false;
                $model->attributes = $_POST['UserLogin'];
                $model->scenario = 'sss';
                if ($model->validate()) {
                    $this->lastViset();
                    if (Yii::app()->user->id) {
                        $model = User::model()->findByPk(Yii::app()->user->id);
                        $user_fullname = $model->username;
                        echo CJSON::encode(array(
                            'status' => 'success',
                            'user_fullname' => $user_fullname,
                        ));
                    }
                    Yii::app()->end();
                } else {
                    $error = CActiveForm::validate($model);
                    if ($error != '[]')
                        echo $error;
                    Yii::app()->end();
                }
            }
            if ($flag) {
                Yii::app()->clientScript->scriptMap['jquery.js'] = false;
                $this->renderPartial('/user/ajax_login', array('model' => $model), false, true);
            }
        } else {
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            $this->renderPartial('/user/ajax_mini_profile', array('model' => $model), false, true);
        }
    }


    private function lastViset() {
        $lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
        $lastVisit->lastvisit = time();
        $lastVisit->save();
    }

}