<?php

class RegistrationController extends Controller {

    public $defaultAction = 'registration';

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
        );
    }

    /**
     * Registration user
     */
    public function actionRegistration() {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            $this->actionAjaxRegistration();
        } else {

            $this->layout = '//layouts/column1';
            $model = new RegistrationForm;
            $profile = new Profile;
            $profile->regMode = true;

            // ajax validator
//            if (isset($_POST['ajax']) && $_POST['ajax'] === 'registration-form') {
//                echo UActiveForm::validate(array($model, $profile));
//                Yii::app()->end();
//            }

            if (Yii::app()->user->id && !Yii::app()->user->getState('service')) {
                $this->redirect(Yii::app()->controller->module->profileUrl);
            } else {
                if (isset($_POST['RegistrationForm'])) {
                    $model->attributes = $_POST['RegistrationForm'];
                    $profile->attributes = ((isset($_POST['Profile']) ? $_POST['Profile'] : array()));

                    if ($model->validate() && $profile->validate()) {
                        $soucePassword = $model->password;
                        $model->activkey = UserModule::encrypting(microtime() . $model->password);
                        $model->password = UserModule::encrypting($model->password);
                        $model->verifyPassword = UserModule::encrypting($model->verifyPassword);
                        $model->superuser = 0;
                        $model->status = ((Yii::app()->controller->module->activeAfterRegister) ? User::STATUS_ACTIVE : User::STATUS_NOACTIVE);

                        if ($model->save(false)) {
                            $profile->user_id = $model->id;
                            $profile->save();

                            //social link
                            if (Yii::app()->user->getState('service')) {
                                $this->linkServiceToUser($model->id);
                            }

                            if (Yii::app()->controller->module->sendActivationMail) {
                                $activation_url = $this->createAbsoluteUrl('/user/activation/activation', array("activkey" => $model->activkey, "email" => $model->email));
                                UserModule::sendMail($model->email, UserModule::t("You registered from {site_name}", array('{site_name}' => Yii::app()->name)), UserModule::t("Please activate you account go to {activation_url}", array('{activation_url}' => $activation_url)));
                            }

                            if ((Yii::app()->controller->module->loginNotActiv || (Yii::app()->controller->module->activeAfterRegister && Yii::app()->controller->module->sendActivationMail == false)) && Yii::app()->controller->module->autoLogin) {
                                $identity = new UserIdentity($model->username, $soucePassword);
                                $identity->authenticate();
                                Yii::app()->user->login($identity, 0);
                                $this->redirect(Yii::app()->controller->module->returnUrl);
                            } else {
                                if (!Yii::app()->controller->module->activeAfterRegister && !Yii::app()->controller->module->sendActivationMail) {
                                    Yii::app()->user->setFlash('registration', UserModule::t("Thank you for your registration. Contact Admin to activate your account."));
                                } elseif (Yii::app()->controller->module->activeAfterRegister && Yii::app()->controller->module->sendActivationMail == false) {
                                    Yii::app()->user->setFlash('registration', UserModule::t("Thank you for your registration. Please {{login}}.", array('{{login}}' => CHtml::link(UserModule::t('Login'), Yii::app()->controller->module->loginUrl))));
                                } elseif (Yii::app()->controller->module->loginNotActiv) {
                                    Yii::app()->user->setFlash('registration', UserModule::t("Thank you for your registration. Please check your email or login."));
                                } else {
                                    Yii::app()->user->setFlash('registration', UserModule::t("Thank you for your registration. Please check your email."));
                                }

//                                 EUserFlash::setSuccessMessage('Doredildi');
                                $this->refresh();
                            }
                        }
                    } else
                        $profile->validate();
                }
                $this->render('/user/registration', array('model' => $model, 'profile' => $profile));
            }
        }
    }

    public function actionAjaxRegistration() {
        $model = new RegistrationForm;
        $profile = new Profile;
        $profile->regMode = true;

        // ajax validator
//        if (isset($_POST['ajax']) && $_POST['ajax'] === 'registration-form') {
//            echo UActiveForm::validate(array($model, $profile));
//            Yii::app()->end();
//        }

//        if (isset($_POST['RegistrationForm'])) {
////            $error = CActiveForm::validate(array($model, $profile));
//            $uActiveForm=new UActiveForm();
//            $uActiveForm->disableAjaxValidationAttributes='RegistrationForm_verifyCode';
//            $error= $uActiveForm->validate(array($model, $profile));
//               if($error!='[]'){
//                   echo CJSON::encode(array(
//                            'status'=>'error',
//                            'message'=> $error,
//                  ));
//                  Yii::app()->end();
//               }
//        }

        if (Yii::app()->user->id && !Yii::app()->user->getState('service')) {
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            $this->renderPartial('/user/ajax_mini_profile', array('model' => $model), false, true);
        } else {
            $flag = true;
            if (isset($_POST['RegistrationForm'])) {
                $flag = false;
                $model->attributes = $_POST['RegistrationForm'];
                $profile->attributes = ((isset($_POST['Profile']) ? $_POST['Profile'] : array()));
                if ($model->validate() && $profile->validate()) {
                    $soucePassword = $model->password;
                    $model->activkey = UserModule::encrypting(microtime() . $model->password);
                    $model->password = UserModule::encrypting($model->password);
                    $model->verifyPassword = UserModule::encrypting($model->verifyPassword);
                    $model->superuser = 0;
                    $model->status = ((Yii::app()->controller->module->activeAfterRegister) ? User::STATUS_ACTIVE : User::STATUS_NOACTIVE);


                    if ($model->save(false)) {
                        $profile->user_id = $model->id;
                        $profile->save();

                        if(Yii::app()->user->getState('service')){
                            $this->linkServiceToUser($model->id);
                        }

                        if (Yii::app()->controller->module->sendActivationMail) {
                            $activation_url = $this->createAbsoluteUrl('/user/activation/activation', array("activkey" => $model->activkey, "email" => $model->email));
                            UserModule::sendMail($model->email, UserModule::t("You registered from {site_name}", array('{site_name}' => Yii::app()->name)), UserModule::t("Please activate you account go to {activation_url}", array('{activation_url}' => $activation_url)));
                        }

                        if ((Yii::app()->controller->module->loginNotActiv || (Yii::app()->controller->module->activeAfterRegister && Yii::app()->controller->module->sendActivationMail == false)) && Yii::app()->controller->module->autoLogin) {
                            $identity = new UserIdentity($model->username, $soucePassword);
                            $identity->authenticate();
                            Yii::app()->user->login($identity, 0);
                            if (Yii::app()->user->id) {
                                $model = User::model()->findByPk(Yii::app()->user->id);
                                $user_fullname = $model->profile->firstname . "  " . $model->profile->lastname;
                                echo CJSON::encode(array(
                                    'status' => 'success',
                                    'user_fullname' => $user_fullname,
                                ));
                            }
                            Yii::app()->end();
                        } else {
                            if (!Yii::app()->controller->module->activeAfterRegister && !Yii::app()->controller->module->sendActivationMail) {
                                Yii::app()->user->setFlash('registration', UserModule::t("Thank you for your registration. Contact Admin to activate your account."));
                            } elseif (Yii::app()->controller->module->activeAfterRegister && Yii::app()->controller->module->sendActivationMail == false) {
                                Yii::app()->user->setFlash('registration', UserModule::t("Thank you for your registration. Please {{login}}.", array('{{login}}' => CHtml::link(UserModule::t('Login'), Yii::app()->controller->module->loginUrl))));
                            } elseif (Yii::app()->controller->module->loginNotActiv) {
                                Yii::app()->user->setFlash('registration', UserModule::t("Thank you for your registration. Please check your email or login."));
                            } else {
                                Yii::app()->user->setFlash('registration', UserModule::t("Thank you for your registration. Please check your email."));
                            }

                            echo CJSON::encode(array(
                                'status' => 'warning',
                                'message' => '<p class="after_register_msg">' . Yii::app()->user->getFlash('registration') . '</p>',
                            ));
                            Yii::app()->end();
                        }
                    } else {
                        echo CJSON::encode(array(
                            'status' => 'error',
                            'message' => $model->getErrors(),
                        ));
                        Yii::app()->end();
                    }
                } else {
                    $uActiveForm = new UActiveForm();
                    $uActiveForm->disableAjaxValidationAttributes = 'RegistrationForm_verifyCode';
                    $error = $uActiveForm->validate(array($model, $profile));
                    if ($error != '[]') {
                        echo CJSON::encode(array(
                            'status' => 'error',
                            'message' => $error,
                        ));
                        Yii::app()->end();
                    }
                }
            }
            if ($flag) {
                Yii::app()->clientScript->scriptMap['jquery.js'] = false;
                $this->renderPartial('/user/ajax_registration', array('model' => $model, 'profile' => $profile), false, true);
            }
        }
    }



    protected function linkServiceToUser($userID){
        $service = new Service;

        $service->identity = Yii::app()->user->id;
        $service->service_name = Yii::app()->user->service;
        $service->user_id = $userID;

        $service->save();
    }
}
