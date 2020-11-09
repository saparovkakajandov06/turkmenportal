<div class="form row">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'banner-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'action' => $model->isNewRecord ? Yii::app()->createUrl('//banner/create') : Yii::app()->createUrl('//banner/update', array('id' => $model->id)),
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));

    echo $form->errorSummary($model);
    ?>

    <?php echo $form->hiddenField($model, 'type'); ?>

    <div class="row">
        <div class="col-md-3">
            <div class="control-group">
                <?php echo $form->labelEx($model, 'format_type', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo $form->dropDownList($model, 'format_type',$model->getFormatTypeOptions()); ?>
                    <div class="help-inline"><?php echo $form->error($model, 'format_type'); ?></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="control-group">
                <?php echo $form->labelEx($model, 'description', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo $form->textField($model, 'description', array('size' => 60, 'maxlength' => 255)); ?>
                    <div class="help-inline"><?php echo $form->error($model, 'description'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="control-group">
                <?php echo $form->labelEx($model, 'adsense_code', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo $form->textArea($model, 'adsense_code',array('style'=>'width:90%; max-width:90%;height:150px')); ?>
                    <div class="help-inline"><?php echo $form->error($model, 'adsense_code'); ?></div>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="control-group">
                <?php echo $form->labelEx($model, 'status', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo $form->dropDownList($model, 'status', $model->getStatusOptions()); ?>
                    <div class="help-inline"><?php echo $form->error($model, 'status'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-actions">
                <?php
                echo CHtml::submitButton(Yii::t('app', 'Save'), array('class' => 'btn btn-success'));
                echo '&nbsp;';
                echo CHtml::Button(Yii::t('app', 'Cancel'), array(
                        'submit' => 'javascript:history.go(-1)',
                        'class' => 'btn btn-inverse'
                    )
                );
                $this->endWidget();
                ?>
            </div>
        </div>
    </div>
</div>
