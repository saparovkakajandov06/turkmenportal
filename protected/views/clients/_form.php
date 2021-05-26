<?php
/* @var $this ClientsController */
/* @var $model Clients */
/* @var $form CActiveForm */
?>

<div class="block-flat">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="form">

                    <?php $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'clients-form',
                        // Please note: When you enable ajax validation, make sure the corresponding
                        // controller action is handling ajax validation correctly.
                        // There is a call to performAjaxValidation() commented in generated controller code.
                        // See class documentation of CActiveForm for details on this.
                        'enableAjaxValidation' => false,
                    )); ?>

                    <p class="note">Fields with <span class="required">*</span> are required.</p>

                    <?php echo $form->errorSummary($model); ?>



                    <div class="row">
                        <div class="col-md-12">
                            <div class="control-group">
                                <?php echo $form->labelEx($model, 'client_name'); ?>
                                <div class="controls">
                                    <?php echo $form->textField($model, 'client_name', array('size' => 60, 'maxlength' => 255)); ?>
                                    <div class="help-inline">
                                        <?php echo $form->error($model, 'client_name'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="control-group">
                                <?php echo $form->labelEx($model, 'description'); ?>
                                <div class="controls">
                                    <?php echo $form->textField($model, 'description', array('size' => 60, 'maxlength' => 255)); ?>
                                    <div class="help-inline">
                                        <?php echo $form->error($model, 'description'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="control-group">
                                <?php echo $form->labelEx($model, 'status', array('class' => 'control-label')); ?>
                                <div class="controls">
                                    <?php echo $form->checkBox($model, 'status'); ?>
                                    <div class="help-inline">
                                        <?php echo $form->error($model, 'status'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls">
                            <?php
                            echo CHtml::submitButton(Yii::t('app', 'Save & Create'), array('class' => 'btn btn-success', 'name' => "save_create"));
                            echo '&nbsp;';
                            echo CHtml::submitButton(Yii::t('app', 'Save'), array('class' => 'btn btn-success'));
                            echo '&nbsp;';
                            echo CHtml::Button(Yii::t('app', 'Cancel'), array(
                                    'submit' => 'javascript:history.go(-1)',
                                    'class' => 'btn btn-danger'
                                )
                            );
                            ?>
                        </div>
                    </div>

                    <?php $this->endWidget(); ?>

                </div><!-- form -->
            </div>
        </div>
    </div>
</div>