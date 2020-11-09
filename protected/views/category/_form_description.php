<div class="wide form">
    
      <?php // echo $form->hiddenField($model,'['.$model->language_id.']language_id'); ?>
      <?php // echo $form->hiddenField($model,'['.$model->language_id.']category_id'); ?>
    
      <div class="control-group">
        <?php echo $form->labelEx($model,'name',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'name_'.$language->code,array('size'=>60,'maxlength'=>255)); ?>
          <div class="help-inline"><?php echo $form->error($model,'name_'.$language->code); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'description',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textArea($model,'description_'.$language->code,array('rows'=>6, 'cols'=>50)); ?>
          <div class="help-inline"><?php echo $form->error($model,'description_'.$language->code); ?>
        </div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'meta_description',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'meta_description_'.$language->code,array('size'=>60,'maxlength'=>255)); ?>
          <div class="help-inline"><?php echo $form->error($model,'meta_description_'.$language->code); ?></div>
        </div>
      </div>
    
      <div class="control-group">
        <?php echo $form->labelEx($model,'meta_keyword',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'meta_keyword_'.$language->code,array('size'=>60,'maxlength'=>255)); ?>
          <div class="help-inline"><?php echo $form->error($model,'meta_keyword_'.$language->code); ?></div>
        </div>
      </div>
    
      <div class="control-group">
        <?php echo $form->labelEx($model,'alias',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'alias_'.$language->code,array('size'=>60,'maxlength'=>255)); ?>
          <div class="help-inline"><?php echo $form->error($model,'alias_'.$language->code); ?></div>
        </div>
      </div>
        
    
  
</div> <!-- form -->