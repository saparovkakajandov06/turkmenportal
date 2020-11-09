<div class="wide form">
    <p class="note">
        <?php echo Yii::t('app','Fields with');?> <span class="required">*</span> <?php echo Yii::t('app','are required');?>.
    </p>

    
      <div class="control-group">
        <?php echo $form->labelEx($model,'code',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'code'); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'code'); ?>
          </div>
        </div>
      </div>
    
      <div class="control-group">
        <?php echo $form->labelEx($model,'bottom',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'bottom'); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'bottom'); ?>
          </div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'sort_order',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'sort_order'); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'sort_order'); ?>
          </div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'status',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->checkBox($model,'status'); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'status'); ?>
          </div>
        </div>
      </div>
        </div> <!-- form -->