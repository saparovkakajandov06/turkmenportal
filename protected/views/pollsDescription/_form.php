<div class="form">
    <p class="note">
        <?php echo Yii::t('app','Fields with');?> <span class="required">*</span> <?php echo Yii::t('app','are required');?>.
    </p>

    <?php
    $form=$this->beginWidget('CActiveForm', array(
    'id'=>'polls-description-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    ));

    echo $form->errorSummary($model);
    ?>
    
      <div class="control-group">
        <?php echo $form->labelEx($model,'polls_id',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'polls_id'); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'polls_id'); ?>
          </div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'language_id',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'language_id'); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'language_id'); ?>
          </div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'question',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'question',array('size'=>60,'maxlength'=>255)); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'question'); ?>
          </div>
        </div>
      </div>
        
  <div class="form-actions">
    <?php
        echo CHtml::submitButton(Yii::t('app', 'Save'),array('class'=>'btn btn-success'));
        echo '&nbsp;';
        echo CHtml::Button(Yii::t('app', 'Cancel'), array(
			                                                'submit' => 'javascript:history.go(-1)',
			                                                'class'  => 'btn btn-inverse'
			                                                )
			                                              );
        $this->endWidget(); ?>
  </div>
</div> <!-- form -->