<div class="wide form">
    <p class="note">
        <?php echo Yii::t('app','Fields with');?> <span class="required">*</span> <?php echo Yii::t('app','are required');?>.
    </p>

    
      <?php echo $form->hiddenField($model,'['.$model->language_id.']language_id'); ?>
      <?php echo $form->hiddenField($model,'['.$model->language_id.']autos_id'); ?>
      <div class="control-group">
        <?php echo $form->labelEx($model,'description',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textArea($model,'['.$model->language_id.']description',array('rows'=>6, 'cols'=>50)); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'description'); ?>
          </div>
        </div>
      </div>
        </div> <!-- form -->