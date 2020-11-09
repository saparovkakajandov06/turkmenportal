<div class="wide form">
    <p class="note">
        <?php echo Yii::t('app','Fields with');?> <span class="required">*</span> <?php echo Yii::t('app','are required');?>.
    </p>

    <?php echo $form->hiddenField($model,'['.$model->language_id.']polls_answers_id'); ?>
    <?php echo $form->hiddenField($model,'['.$model->language_id.']language_id'); ?>
    
     
      <div class="control-group">
        <?php echo $form->labelEx($model,'answer',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'['.$model->language_id.']answer',array('size'=>60,'maxlength'=>255)); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'answer'); ?>
          </div>
        </div>
      </div>
        </div> <!-- form -->