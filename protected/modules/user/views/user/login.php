<?php
$this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Login");
$this->breadcrumbs = array(
    UserModule::t("Login"),
);
?>

<div class="form-group-fluid">
    <div class="span4">
        <a href="<?php echo Yii::app()->homeUrl; ?>">
            <div class="logo">
            </div>
        </a>
    </div>

</div>

<?php if (Yii::app()->user->hasFlash('loginMessage')): ?>
    <div class="success">
        <?php echo Yii::app()->user->getFlash('loginMessage'); ?>
    </div>
<?php endif; ?>


<div class="row">
    <div class="col-md-5 col-md-offset-3">
        <div class="col-lg-12">
            <h3><?php echo UserModule::t("Login"); ?></h3>
        </div>

        <div class="col-md-12">
            <div class="obyawa_form">
                <div class="form">
                    <?php
                    $form = $this->beginWidget('UActiveForm', array(
                        'id' => 'login-form',
                        'enableAjaxValidation' => false,
                    ));
                    ?>

                    <?php echo CHtml::errorSummary($model); ?>
                    <div class="row">
                        <p class="note">
                            <?php echo Yii::t('app', 'dont_you_have_account'); ?>
                            <?php echo CHtml::link(UserModule::t("Register"), Yii::app()->getModule('user')->registrationUrl); ?>
                        </p>
                    </div>

                    <div class="row">
                        <div class="control-group">
                            <div class="controls">
                                <?php echo $form->textField($model, 'username', array('size' => 60, 'maxlength' => 255, 'placeholder' => $model->getAttributeLabel('username'))); ?>
                                <div class="help-inline">
                                    <?php echo $form->error($model, 'username'); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="control-group">
                            <div class="controls">
                                <?php echo $form->passwordField($model, 'password', array('size' => 60, 'maxlength' => 255, 'placeholder' => $model->getAttributeLabel('password'))); ?>
                                <div class="help-inline">
                                    <?php echo $form->error($model, 'password'); ?>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="controls">
                                    <?php echo $form->checkBox($model, 'rememberMe'); ?>
                                    <?php echo $form->labelEx($model, 'rememberMe', array('class' => 'control-label remember_me')); ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <p class="note">
                                    <?php echo CHtml::link(UserModule::t("Lost Password?"), Yii::app()->getModule('user')->recoveryUrl); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-actions">
                    <?php
                    echo CHtml::submitButton(UserModule::t("Login"), array('class' => 'btn btn-success'));
                    echo '&nbsp;';
                    echo CHtml::link(Yii::t('app', 'Cancel'), Yii::app()->user->returnUrl, array('class' => 'btn btn-inverse'));
                    ?>
                </div>


                <?php $this->endWidget(); ?>

            </div>

            <hr>
            <p class="note">
                <?php echo Yii::t('app', 'or_login_with_social_services'); ?>
            </p>
            <?php
            $this->widget('ext.eauth.EAuthWidget', array(
                'action' => 'login'
            ));
            ?>
        </div>

    </div>
</div>


