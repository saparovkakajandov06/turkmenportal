<?php

class UsersController extends Controller
{
   public function actionRegistration() {

        $model = new RegistrationForm;
        $profile=new Profile;
        $profile->regMode = true;

        // ajax validator
        if(isset($_POST['ajax']) && $_POST['ajax']==='registration-form')
        {
            echo UActiveForm::validate(array($model,$profile));
            Yii::app()->end();
        }


            if (Yii::app()->user->id){
                $this->redirect(Yii::app()->getModule('user')->profileUrl);
            } else {
                $flag=true;
                if(isset($_POST['RegistrationForm'])) {
                    $flag=false;
                    $model->attributes=$_POST['RegistrationForm'];
                    $profile->attributes=((isset($_POST['Profile'])?$_POST['Profile']:array()));
                    if($model->validate()&&$profile->validate()){
                        $soucePassword = $model->password;
                        $model->activkey=UserModule::encrypting(microtime().$model->password);
                        $model->password=UserModule::encrypting($model->password);
                        $model->verifyPassword=UserModule::encrypting($model->verifyPassword);
                        $model->superuser=0;
                        $model->status=((Yii::app()->controller->module->activeAfterRegister)?User::STATUS_ACTIVE:User::STATUS_NOACTIVE);

                        if ($model->save()) {
                            $profile->user_id=$model->id;
                            $profile->save();
                            if (Yii::app()->controller->module->sendActivationMail) {
                                $activation_url = $this->createAbsoluteUrl('/user/activation/activation',array("activkey" => $model->activkey, "email" => $model->email));
                                UserModule::sendMail($model->email,UserModule::t("You registered from {site_name}",array('{site_name}'=>Yii::app()->name)),UserModule::t("Please activate you account go to {activation_url}",array('{activation_url}'=>$activation_url)));
                            }

                            if ((Yii::app()->controller->module->loginNotActiv||(Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false))&&Yii::app()->controller->module->autoLogin) {
                                $identity=new UserIdentity($model->username,$soucePassword);
                                $identity->authenticate();
                                Yii::app()->user->login($identity,0);
                                $this->redirect(Yii::app()->controller->module->returnUrl);
                            } else {
                                if (!Yii::app()->controller->module->activeAfterRegister&&!Yii::app()->controller->module->sendActivationMail) {
                                        Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Contact Admin to activate your account."));
                                } elseif(Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false) {
                                        Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please {{login}}.",array('{{login}}'=>CHtml::link(UserModule::t('Login'),Yii::app()->controller->module->loginUrl))));
                                } elseif(Yii::app()->controller->module->loginNotActiv) {
                                        Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please check your email or login."));
                                } else {
                                        Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please check your email."));
                                }
                                $this->refresh();
                            }
                        }
                    } else $profile->validate();
                }
                    if($flag==true){
                        Yii::app()->clientScript->scriptMap['jquery.js'] = false;
                        $this->renderPartial('//users/registration', array('model' => $model,'profile'=>$profile), false, true);
                    }
            }
   }

   public function actionAjaxLogin()
   {
       $model=new UserLogin;
       $model->scenario = 'ajaxLogin';
       if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
           echo CActiveForm::validate($model);
           Yii::app()->end();
       }

       if (Yii::app()->user->isGuest) {
           // collect user input data
           $flag=true;
           if(isset($_POST['UserLogin']))
			{
                $flag=false;
				$model->attributes=$_POST['UserLogin'];
                $model->scenario='sss';
				if($model->validate()) {

                    if(Yii::app()->user->id){
                        $model=User::model()->findByPk(Yii::app()->user->id);
                        $user_fullname=$model->profile->firstname."  ".$model->profile->lastname;
                        echo CJSON::encode(array(
                            'status'=>'success',
                            'user_fullname'=> $user_fullname,
                        ));
                    }

                     Yii::app()->end();
				} else {
                    $error = CActiveForm::validate($model);
                    if($error!='[]')
                        echo $error;
                    Yii::app()->end();
                }
			}

           if($flag)
           {
               Yii::app()->clientScript->scriptMap['jquery.js'] = false;
               $this->renderPartial('//users/login', array('model' => $model), false, true);
           }
       } else {
           Yii::app()->clientScript->scriptMap['jquery.js'] = false;
           $this->renderPartial('//users/mini_profile', array('model' => $model), false, true);
       }
   }

}
?>