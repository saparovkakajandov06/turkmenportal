<?php $this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Change Password");
$this->breadcrumbs = array(
    UserModule::t("Profile") => array('/user/profile'),
    UserModule::t("Change Password"),
);
$this->menu = array(
//	((UserModule::isAdmin())
//		?array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin'))
//		:array()),
//    array('label' => UserModule::t('List User'), 'url' => array('/user')),
    array('label' => UserModule::t('Profile'), 'url' => array('/user/profile')),
    array('label' => UserModule::t('Edit'), 'url' => array('/user/profile/edit')),
    array('label' => UserModule::t('Change password'), 'url' => array('/user/profile/changepassword')),
    array('label' => UserModule::t('Logout'), 'url' => array('/user/logout')),
);
?>


<h1><?php echo UserModule::t("Change password"); ?></h1>
<div id="dynamicFormWrapper">
    <div class="form wide">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'changepassword-form',
            'enableAjaxValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
        )); ?>

        <p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
        <?php echo $form->errorSummary($model); ?>

        <div class="control-group">
            <?php echo CHtml::activelabelEx($model, 'oldPassword', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->passwordField($model, 'oldPassword', array('size' => 60, 'maxlength' => 255, 'placeholder' => $model->getAttributeLabel('oldPassword'))); ?>
                <div class="help-inline">
                    <?php echo $form->error($model, 'oldPassword'); ?>
                </div>
            </div>
        </div>

        <div class="control-group">
            <?php echo CHtml::activelabelEx($model, 'password', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->passwordField($model, 'password', array('size' => 60, 'maxlength' => 255, 'placeholder' => $model->getAttributeLabel('password'))); ?>
                <div class="help-inline">
                    <?php echo $form->error($model, 'password'); ?>
                </div>
            </div>
            <p class="note">
                <?php echo UserModule::t("Minimal password length 4 symbols."); ?>
            </p>
        </div>

        <div class="control-group">
            <?php echo CHtml::activelabelEx($model, 'verifyPassword', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->passwordField($model, 'verifyPassword', array('size' => 60, 'maxlength' => 255, 'placeholder' => $model->getAttributeLabel('verifyPassword'))); ?>
                <div class="help-inline">
                    <?php echo $form->error($model, 'verifyPassword'); ?>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <?php echo CHtml::submitButton(UserModule::t("Save")); ?>
        </div>


        <?php $this->endWidget(); ?>
    </div>
</div>
