<div class="wide form">
    <p class="note">
        <?php echo Yii::t('app','Fields with');?> <span class="required">*</span> <?php echo Yii::t('app','are required');?>.
    </p>

    
      <div class="control-group">
        <?php echo $form->labelEx($model,'type',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->dropDownList($model,'type',$model->getTypeOptions()); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'type'); ?>
          </div>
        </div>
      </div>
        
    
      <div class="control-group">
        <?php echo $form->labelEx($model,'parent_id',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->dropDownList($model,'parent_id',$model->getParentPages(),array('empty'=>'')); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'parent_id'); ?>
          </div>
        </div>
      </div>
        
    
      <div class="control-group">
        <?php echo $form->labelEx($model,'code',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'code',array('size'=>60,'maxlength'=>255)); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'code'); ?>
          </div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'top',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->checkBox($model,'top'); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'top'); ?>
          </div>
        </div>
      </div>
    
      <div class="control-group">
        <?php echo $form->labelEx($model,'slider',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->checkBox($model,'slider'); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'slider'); ?>
          </div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'column',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'column'); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'column'); ?>
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