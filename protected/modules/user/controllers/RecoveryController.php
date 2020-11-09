<?php

class RecoveryController extends Controller {
    public $defaultAction = 'recovery';

    /**
     * Recovery password
     */
    public function actionRecovery() {
        $this->layout = '//layouts/column1';

        $recoveryFormModel = new UserRecoveryForm;
        if (Yii::app()->user->id) {
            $this->redirect(Yii::app()->controller->module->returnUrl);
        } else {
            $email = ((isset($_GET['email'])) ? $_GET['email'] : '');
            $activkey = ((isset($_GET['activkey'])) ? $_GET['activkey'] : '');
            if ($email && $activkey) {
                $changePasswordModel = new UserChangePassword;
                $find = User::model()->notsafe()->findByAttributes(array('email' => $email));
                if (isset($find) && $find->activkey == $activkey) {
                    if (isset($_POST['UserChangePassword'])) {
                        $changePasswordModel->attributes = $_POST['UserChangePassword'];
                        if ($changePasswordModel->validate()) {
                            $find->password = Yii::app()->controller->module->encrypting($changePasswordModel->password);
                            $find->activkey = Yii::app()->controller->module->encrypting(microtime() . $changePasswordModel->password);
                            if ($find->status == 0) {
                                $find->status = 1;
                            }
                            $find->save();
                            Yii::app()->user->setFlash('recoveryMessage', UserModule::t("New password is saved."));
                            $this->redirect(Yii::app()->controller->module->recoveryUrl);
                        }
                    }
                    $this->render('changepassword', array('model' => $changePasswordModel));
                } else {
                    Yii::app()->user->setFlash('recoveryMessage', UserModule::t("Incorrect recovery link."));
                    $this->redirect(Yii::app()->controller->module->recoveryUrl);
                }
            } else {
                if (isset($_POST['UserRecoveryForm'])) {
                    $recoveryFormModel->attributes = $_POST['UserRecoveryForm'];
                    if ($recoveryFormModel->validate()) {
                        $user = User::model()->notsafe()->findbyPk($recoveryFormModel->user_id);
                        $activation_url = 'http://' . $_SERVER['HTTP_HOST'] . $this->createUrl(implode(Yii::app()->controller->module->recoveryUrl), array("activkey" => $user->activkey, "email" => $user->email));

                        $subject = UserModule::t("You have requested the password recovery site {site_name}",
                            array(
                                '{site_name}' => Yii::app()->name,
                            ));

                        $message = UserModule::t("You have requested the password recovery site {site_name}. To receive a new password, go to {activation_url}.",
                            array(
                                '{site_name}' => Yii::app()->name,
                                '{activation_url}' => CHtml::link($activation_url, $activation_url)
                            ));

                        if (UserModule::sendMail($user->email, $subject, $message)){
                            Yii::app()->user->setFlash('recoveryMessage', UserModule::t("Please check your email. An instructions was sent to your email address."));
                        }

                        $this->refresh();
                    }
                }
                $this->render('recovery', array('model' => $recoveryFormModel));
            }
        }
    }

}