<div class="wide form">
    <p class="note">
        <?php echo Yii::t('app','Fields with');?> <span class="required">*</span> <?php echo Yii::t('app','are required');?>.
    </p>

    
      <div class="control-group">
        <?php echo $form->labelEx($model,'language_id',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'language_id',array('size'=>11,'maxlength'=>11)); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'language_id'); ?>
          </div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'estates_id',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'estates_id',array('size'=>11,'maxlength'=>11)); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'estates_id'); ?>
          </div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'description',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'description'); ?>
          </div>
        </div>
      </div>
        </div> <!-- form -->