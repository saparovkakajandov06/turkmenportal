<?php
$this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Registration");
$this->breadcrumbs = array(
    UserModule::t("Registration"),
);
?>

<!--<div class="row-fluid">
    <div class="span4">
        <a href="<?php // echo Yii::app()->homeUrl; ?>">
            <div class="logo"></div>
        </a>
    </div>
</div>-->

<?php if (Yii::app()->user->hasFlash('registration')): ?>
    <div class="success">
        <?php echo Yii::app()->user->getFlash('registration'); ?>
    </div>
<?php else: ?>


    <div class="">
        <div class="form  input_250 login_wrapper" id="registration-form">
            <h2 class="login_header"><?php echo UserModule::t('Registration')?></h2>
            <p class="controls">		
                <?php echo Yii::t('app','if_you_have_account'); ?>
                <?php echo CHtml::ajaxLink(UserModule::t("Login"),Yii::app()->createUrl('/user/login'),
                    $ajaxOptions=array(
                            'success'=>'js:function(data){
                                console.log(data);
                                $("#nav-popup-inner").html(data);
                                $(".nav-popup").addClass("opened");   
                                $(".nav-popup").slideDown(500);   
                            }'
                        ),
                        $htmlOptions=array('id'=>'ajax_login')    
                    ); 
                ?> 
            </p>
            <?php
                $form = $this->beginWidget('UActiveForm', array(
                    'id' => 'registration-form',
                    'enableAjaxValidation' => true,
                    'disableAjaxValidationAttributes' => array('RegistrationForm_verifyCode'),
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                        'validateOnChange' => false,
                        'validateOnType' => false,
                    ),
                    'action' => Yii::app()->createUrl('/user/registration'),
                    'htmlOptions' => array('enctype' => 'multipart/form-data'),
                ));
            ?>

            <?php echo $form->errorSummary(array($model, $profile)); ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="control-group">
                        <div class="controls">
                            <?php echo $form->textField($model, 'username',array('placeholder' => $model->getAttributeLabel('username'))); ?>
                            <div class="help-inline">
                                <?php echo $form->error($model, 'username'); ?>
                            </div>
                        </div>
                    </div>



                    <div class="control-group">
                        <div class="controls">
                            <?php echo $form->textField($model, 'email',array('placeholder' => $model->getAttributeLabel('email'))); ?>
                            <div class="help-inline">
                                <?php echo $form->error($model, 'email'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls">
                            <?php echo $form->passwordField($model, 'password',array('placeholder' => $model->getAttributeLabel('password'))); ?>
                            <div class="help-inline">
                                <?php echo $form->error($model, 'password'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls">
                            <?php echo $form->passwordField($model, 'verifyPassword',array('placeholder' => $model->getAttributeLabel('verifyPassword'))); ?>
                            <div class="help-inline">
                                <?php echo $form->error($model, 'verifyPassword'); ?>
                            </div>
                        </div>
                    </div>

                    <?php
                    $profileFields = $profile->getFields();
                    if ($profileFields) {
                        foreach ($profileFields as $field) {
                            ?>
                            <div class="control-group">
                                <?php
                                if ($widgetEdit = $field->widgetEdit($profile)) {
                                    echo $widgetEdit;
                                } elseif ($field->range) {
                                    echo $form->dropDownList($profile, $field->varname, Profile::range($field->range));
                                } elseif ($field->field_type == "TEXT") {
                                    echo$form->textArea($profile, $field->varname, array('rows' => 6, 'cols' => 50,'placeholder' => $profile->getAttributeLabel($field->varname)));
                                } else {
                                    echo $form->textField($profile, $field->varname, array('size' => 60, 'maxlength' => (($field->field_size) ? $field->field_size : 255),'placeholder' => $profile->getAttributeLabel($field->varname)));
                                }
                                ?>
                                <?php echo $form->error($profile, $field->varname); ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>

                <div class="col-md-4">

                    <?php if (UserModule::doCaptcha('registration')): ?>

<!--                        --><?php //echo CHtml::activeLabel($user, 'verifyCode'); ?>
<!--                        --><?php //$this->widget('application.extensions.recaptcha.EReCaptcha',
//                            array('model'=>$model, 'attribute'=>'verifyCode',
//                                'theme'=>'red', 'language'=>'ru_RU',
//                                'publicKey'=>'test')) ?>
<!--                        --><?php //echo CHtml::error($user, 'verifyCode'); ?>

                        <div class="control-group">
                            <?php echo CHtml::activeLabel($model, 'verifyCode'); ?>
                            <?php
                            $form->widget('application.extensions.reCaptcha2.SReCaptcha',
                                [
                                    'name' => 'verifyCode', //is requred
                                    'siteKey' => Yii::app()->params['reCaptcha']['publicKey'],
                                    'model' => $model,
                                    'attribute' => 'verifyCode'
                                ]
                            );
//                            $this->widget('application.extensions.recaptcha.EReCaptcha',
//                                array('model' => $model, 'attribute' => 'verifyCode',
//                                    'theme' => 'red', 'language' => 'ru_RU',
//                                    'publicKey' => Yii::app()->params['reCaptcha']['publicKey']))
                            ?>
                            <?php echo $form->error($model, 'verifyCode'); ?>
                        </div>
<!---->
<!--                        <div class="row">-->
<!--                            --><?php //echo $form->labelEx($model,'verifyCode'); ?>
<!---->
<!--                            --><?php //$this->widget('CCaptcha'); ?>
<!--                            --><?php //echo $form->textField($model,'verifyCode'); ?>
<!--                            --><?php //echo $form->error($model,'verifyCode'); ?>
<!---->
<!--                            <p class="hint">--><?php //echo UserModule::t("Please enter the letters as they are shown in the image above."); ?>
<!--                                <br/>--><?php //echo UserModule::t("Letters are not case-sensitive."); ?><!--</p>-->
<!--                        </div>-->

                    <?php endif; ?>
                </div>
                
               
            </div>
            
            
             <div class="row">
                <div class="col-md-12">
                    <div class=" action-footer">
                        <?php
                        echo CHtml::ajaxSubmitButton(UserModule::t('Register'), CHtml::normalizeUrl(array('/user/registration', 'render' => false)), array('success' => 'js:function(data){
                         debugger;
                         var data = $.parseJSON(data);
                         if(data.status=="success"){
                                $("#nav-popup-inner").html("");
                                $(".nav-popup").removeClass("opened");   
                                $(".nav-popup").slideUp(300);   
                                $(".background_glow").hide();
                                $(".ajaxLogin").text(data.user_fullname);
                        }
                        if(data.status=="warning"){
                                $("#nav-popup-inner").html(data.message);
                        }
                        else{
                            var message=  $.parseJSON(data.message);
                            $("#registration-form .errorMessage").hide();
                            $.each(message, function(key, val) {
                                $("#registration-form #"+key+"_em_").text(val);                                                    
                                $("#registration-form #"+key+"_em_").show();
                            });
                            jQuery("#recaptcha_reload").click(); 
                        }     
                    }'), array('id' => 'close_employees_create_dialog' . uniqid(), 'class' => "btn btn-success")
                        );
                        ?>
                    </div>
                </div>
                </div>
            <?php $this->endWidget(); ?>
        </div><!-- form -->
    </div>
<?php endif; ?>