<?php $this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Restore");
$this->breadcrumbs = array(
    UserModule::t("Login") => array('/user/login'),
    UserModule::t("Restore"),
);
?>
<div class="row">

    <div class="col-md-5 col-md-offset-3">
        <div class="col-lg-12">
            <h3><?php echo UserModule::t("Restore"); ?></h3>
        </div>
        <div class="col-md-12">
            <?php if (Yii::app()->user->hasFlash('recoveryMessage')): ?>
                <div class="success">
                    <?php echo Yii::app()->user->getFlash('recoveryMessage'); ?>
                </div>
            <?php else: ?>

            <div class="obyawa_form">
                <div class="form">
                    <?php
                    $form = $this->beginWidget('UActiveForm', array(
                        'id' => 'recovery-form',
                        'enableAjaxValidation' => false,
                    ));
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo CHtml::errorSummary($model); ?>
                        </div>
                    </div>

                    <div class="row"
                    <div class="control-group">
                        <div class="controls">
                            <?php echo $form->textField($model, 'login_or_email', array('placeholder' => $model->getAttributeLabel('login_or_email'))); ?>
                            <div class="help-inline">
                                <?php echo $form->error($model, 'login_or_email'); ?>
                            </div>
                        </div>
                        </br>
                        <small>
                            <?php echo UserModule::t("Please enter your login or email addres."); ?>
                        </small>
                    </div>
                </div>
                <div class="form-actions">
                    <?php
                        echo CHtml::submitButton(UserModule::t("Restore"), array('class' => 'btn btn-success'));
                        echo '&nbsp;';
                        echo CHtml::link(Yii::t('app', 'Cancel'), Yii::app()->user->returnUrl, array('class' => 'btn btn-inverse'));
                    ?>
                </div>

                <?php $this->endWidget(); ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

</div>
