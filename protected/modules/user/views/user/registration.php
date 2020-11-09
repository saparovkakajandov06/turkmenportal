<?php $this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Registration");
$this->breadcrumbs = array(
    UserModule::t("Registration"),
);
?>

    <div class="row-fluid">
        <div class="span4">
            <a href="<?php echo Yii::app()->homeUrl; ?>">
                <div class="logo">
                </div>
            </a>
        </div>
    </div>


<?php if (Yii::app()->user->hasFlash('registration')): ?>
    <div class="messages">
        <div class="alert alert-success">
            <?php echo Yii::app()->user->getFlash('registration'); ?>
        </div>
    </div>
<?php else: ?>


    <div class="obyawa_form login_block">
        <h3 class="header"><?php echo UserModule::t("Registration"); ?></h3>

        <div class="form wide input_250 ">
            <?php $form = $this->beginWidget('UActiveForm', array(
                'id' => 'registration-form',
                'enableAjaxValidation' => false,
                'disableAjaxValidationAttributes' => array('RegistrationForm_verifyCode'),
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'validateOnChange' => false,
                    'validateOnType' => false,
                ),
                'htmlOptions' => array('enctype' => 'multipart/form-data'),
            )); ?>


            <p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

            <?php echo $form->errorSummary(array($model, $profile)); ?>

            <div class="control-group">
                <?php echo $form->labelEx($model, 'username', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo $form->textField($model, 'username'); ?>
                    <div class="help-inline">
                        <?php echo $form->error($model, 'username'); ?>
                    </div>
                </div>
            </div>

            <div class="control-group">
                <?php echo $form->labelEx($model, 'password', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo $form->passwordField($model, 'password'); ?>
                    <div class="help-inline">
                        <?php echo $form->error($model, 'password'); ?>
                    </div>
                </div>
                <p class="hint">
                    <?php echo UserModule::t("Minimal password length 4 symbols."); ?>
                </p>
            </div>


            <div class="control-group">
                <?php echo $form->labelEx($model, 'verifyPassword', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo $form->passwordField($model, 'verifyPassword'); ?>
                    <div class="help-inline">
                        <?php echo $form->error($model, 'verifyPassword'); ?>
                    </div>
                </div>
            </div>


            <div class="control-group">
                <?php echo $form->labelEx($model, 'email', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo $form->textField($model, 'email'); ?>
                    <div class="help-inline">
                        <?php echo $form->error($model, 'email'); ?>
                    </div>
                </div>
            </div>


            <?php
            $profileFields = $profile->getFields();
            if ($profileFields) {
                foreach ($profileFields as $field) {
                    ?>
                    <div class="control-group">

                        <?php echo $form->labelEx($profile, $field->varname); ?>
                        <div class="controls">
                            <?php
                            if ($widgetEdit = $field->widgetEdit($profile)) {
                                echo $widgetEdit;
                            } elseif ($field->range) {
                                echo $form->dropDownList($profile, $field->varname, Profile::range($field->range));
                            } elseif ($field->field_type == "TEXT") {
                                echo $form->textArea($profile, $field->varname, array('rows' => 6, 'cols' => 50));
                            } else {
                                echo $form->textField($profile, $field->varname, array('size' => 60, 'maxlength' => (($field->field_size) ? $field->field_size : 255)));
                            }
                            ?>
                            <div class="help-inline">
                                <?php echo $form->error($profile, $field->varname); ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>


            <?php if (UserModule::doCaptcha('registration')): ?>
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
                    //            $this->widget('application.extensions.reCaptcha2.SReCaptcha',
                    //                array('model' => $model, 'attribute' => 'verifyCode',
                    //                    'theme' => 'red', 'language' => 'ru_RU',
                    //                    'publicKey' => Yii::app()->params['reCaptcha']['publicKey']))
                    ?>
                </div>
            <?php endif; ?>

            <div class="form-actions">
                <?php
                echo CHtml::submitButton(UserModule::t("Register"), array('class' => 'btn btn-success'));
                echo '&nbsp;';
                echo CHtml::Button(Yii::t('app', 'Cancel'), array(
                        'submit' => 'javascript:history.go(-1)',
                        'class' => 'btn btn-inverse'
                    )
                );
                ?>
            </div>


            <?php $this->endWidget(); ?>
        </div><!-- form -->
    </div><!-- form -->
<?php endif; ?>