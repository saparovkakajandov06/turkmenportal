<?php $this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Change Password");
$this->breadcrumbs = array(
    UserModule::t("Login") => array('/user/login'),
    UserModule::t("Change Password"),
);
?>

<div class="row">
    <div class="col-md-5 col-md-offset-3">
        <div class="col-lg-12">
            <h3><?php echo UserModule::t("Change password"); ?></h3>
        </div>
        <div class="col-md-12">

            <div class="form">
                <?php
                $form = $this->beginWidget('UActiveForm', array(
                    'id' => 'recovery-form',
                    'enableAjaxValidation' => false,
                ));

                echo CHtml::beginForm(); ?>

                <div class="row">
                    <p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
                    <?php echo CHtml::errorSummary($model); ?>
                </div>
                <div class="row">
                    <div class="control-group">
                        <div class="controls">
                            <?php echo $form->passwordField($model, 'password', array('placeholder' => $model->getAttributeLabel('password'))); ?>
                        </div>
                        <p class="note"><?php echo UserModule::t("Minimal password length 4 symbols."); ?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="control-group">
                        <div class="controls">
                            <?php echo $form->passwordField($model, 'verifyPassword', array('placeholder' => $model->getAttributeLabel('verifyPassword'))); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-actions">
                        <?php
                        echo CHtml::submitButton(UserModule::t("Save"), array('class' => 'btn btn-success'));
                        echo '&nbsp;';
                        echo CHtml::Button(Yii::t('app', 'Cancel'), array(
                                'submit' => 'javascript:history.go(-1)',
                                'class' => 'btn btn-inverse'
                            )
                        );
                        ?>
                    </div>
                </div>

                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>