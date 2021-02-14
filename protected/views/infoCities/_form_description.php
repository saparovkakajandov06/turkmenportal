<div class=" form">
    <p class="note">
        <?php echo Yii::t('app','Fields with');?> <span class="required">*</span> <?php echo Yii::t('app','are required');?>.
    </p>
    
   
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'name',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'name_'.$language->code,array('size'=>60,'maxlength'=>255)); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'name_'.$language->code); ?>
          </div>
        </div>
      </div>

    <div class="control-group">
        <?php echo $form->labelEx($model,'country',array('class'=>'control-label')) ; ?>
        <div class="controls">
            <?php echo $form->textField($model,'country_'.$language->code,array('size'=>60,'maxlength'=>255)); ?>
            <div class="help-inline">
                <?php echo $form->error($model,'country_'.$language->code); ?>
            </div>
        </div>
    </div>
     
    
</div> <!-- form -->