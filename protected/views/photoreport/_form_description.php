<div class=" form">
    <p class="note">
        <?php echo Yii::t('app','Fields with');?> <span class="required">*</span> <?php echo Yii::t('app','are required');?>.
    </p>
    
   
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'title',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'title_'.$language->code,array('size'=>60,'maxlength'=>255)); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'title_'.$language->code); ?>
          </div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'description',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textArea($model,'description_'.$language->code); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'description_'.$language->code); ?>
          </div>
        </div>
      </div>
    
    <div class="control-group">
        <?php echo $form->labelEx($model,'tag',array('class'=>'control-label')) ; ?>
        <div class="controls">
            <?php $this->widget('CAutoComplete', array(
                'name' => 'tags'.$language->code,
                'value' => $model->{tags.$language->code}->toString(),
                'url'=>Yii::app()->createUrl('//tag/autocomplete'),
                'multiple'=>true,
                'mustMatch'=>false,
                'matchCase'=>false,
                'max'=>50, 
                'minChars'=>2, 
                'delay'=>50, 
                'textArea'=>TRUE,
                'autoFill'=>true,
            )); ?>
        </div> 
    </div> 
        
    
      <div class="control-group">
        <?php echo $form->labelEx($model,'text',array('class'=>'control-label')) ; ?>
        <div class="controls">
                
            <?php
                //Example with model
                $this->widget('ext.editMe.widgets.ExtEditMe', array(
                    'model'=>$model,
                    'attribute'=>'text_'.$language->code,
                    'filebrowserBrowseUrl'=>  Yii::app()->baseUrl.'/kcfinder/browse.php?type=files',
                    'filebrowserImageBrowseUrl'=>  Yii::app()->baseUrl.'/kcfinder/browse.php?type=images',
                    'filebrowserImageBrowseLinkUrl'=>Yii::app()->baseUrl.'/kcfinder/browse.php?type=images',
                    'filebrowserImageUploadUrl'=>Yii::app()->baseUrl.'/kcfinder/upload.php?type=images',
                    'filebrowserUploadUrl'=>Yii::app()->baseUrl.'/kcfinder/upload.php?type=files',
                ));
            ?>  
          <div class="help-inline">
                <?php echo $form->error($model,'text_'.$language->code); ?>
          </div>
        </div>
      </div>
    
    
    
     
    
</div> <!-- form -->