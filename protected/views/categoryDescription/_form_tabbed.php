<div class="wide form">
    
      <?php echo $form->hiddenField($model,'['.$model->language_id.']language_id'); ?>
      <?php echo $form->hiddenField($model,'['.$model->language_id.']category_id'); ?>
    
      <div class="control-group">
        <?php echo $form->labelEx($model,'name',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'['.$model->language_id.']name',array('size'=>60,'maxlength'=>255)); ?>
          <div class="help-inline"><?php echo $form->error($model,'name'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'description',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textArea($model,'['.$model->language_id.']description',array('rows'=>6, 'cols'=>50)); ?>
          <div class="help-inline"><?php echo $form->error($model,'description'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'meta_description',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'['.$model->language_id.']meta_description',array('size'=>60,'maxlength'=>255)); ?>
          <div class="help-inline"><?php echo $form->error($model,'meta_description'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'meta_keyword',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'['.$model->language_id.']meta_keyword',array('size'=>60,'maxlength'=>255)); ?>
          <div class="help-inline"><?php echo $form->error($model,'meta_keyword'); ?>
</div>
        </div>
      </div>
  
</div> <!-- form -->