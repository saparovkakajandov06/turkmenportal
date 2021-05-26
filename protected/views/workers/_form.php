<?php
/* @var $this WorkersController */
/* @var $model Workers */
/* @var $form CActiveForm */
?>
<div class="block-flat">
    <div class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="form">

                    <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'workers-form',
                        // Please note: When you enable ajax validation, make sure the corresponding
                        // controller action is handling ajax validation correctly.
                        // There is a call to performAjaxValidation() commented in generated controller code.
                        // See class documentation of CActiveForm for details on this.
                        'enableAjaxValidation'=>false,
                    )); ?>

                    <p class="note">Fields with <span class="required">*</span> are required.</p>

                    <?php echo $form->errorSummary($model); ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="control-group">
                                <?php echo $form->labelEx($model,'firstname'); ?>
                                <div class="controls">
                                    <?php echo $form->textField($model,'firstname',array('size'=>60,'maxlength'=>100)); ?>
                                    <div class="help-inline">
                                        <?php echo $form->error($model,'firstname'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="control-group">
                                <?php echo $form->labelEx($model,'lastname'); ?>
                                <div class="controls">
                                    <?php echo $form->textField($model,'lastname',array('size'=>60,'maxlength'=>100)); ?>
                                    <div class="help-inline">
                                        <?php echo $form->error($model,'lastname'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="control-group">
                                <?php echo $form->labelEx($model,'nickname'); ?>
                                <div class="controls">
                                    <?php echo $form->textField($model,'nickname',array('size'=>60,'maxlength'=>100)); ?>
                                    <div class="help-inline">
                                        <?php echo $form->error($model,'nickname'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="control-group">
                                <?php echo $form->labelEx($model,'position'); ?>
                                <div class="controls">
                                    <?php echo $form->textField($model,'position',array('size'=>60,'maxlength'=>100)); ?>
                                    <div class="help-inline">
                                        <?php echo $form->error($model,'position'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="control-group">
                        <?php echo $form->labelEx($model, 'status', array('class' => 'control-label')); ?>
                        <div class="controls">
                            <?php echo $form->checkBox($model, 'status'); ?>
                            <div class="help-inline">
                                <?php echo $form->error($model, 'status'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls">
                            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>

                        </div>
                    </div>

                    <?php $this->endWidget(); ?>

                </div><!-- form -->
            </div>
        </div>
    </div>
</div>