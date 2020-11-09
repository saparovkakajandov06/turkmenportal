<div class=" form">
    <p class="note">
        <?php echo Yii::t('app','Fields with');?> <span class="required">*</span> <?php echo Yii::t('app','are required');?>.
    </p>
          
        
      <?php // echo $form->hiddenField($model,'['.$model->language_id.']language_id'); ?>
      <?php // echo $form->hiddenField($model,'['.$model->language_id.']catalog_id'); ?>

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
        <?php echo $form->labelEx($model,'content',array('class'=>'control-label')) ; ?>
        <div class="controls">
            <?php
                //Example with model
                $this->widget('ext.editMe.widgets.ExtEditMe', array(
                    'model'=>$model,
                    'attribute'=>'content_'.$language->code,
                    'filebrowserBrowseUrl'=>  Yii::app()->baseUrl.'/kcfinder/browse.php?type=files',
                    'filebrowserImageBrowseUrl'=>  Yii::app()->baseUrl.'/kcfinder/browse.php?type=images',
                    'filebrowserImageBrowseLinkUrl'=>Yii::app()->baseUrl.'/kcfinder/browse.php?type=images',
                    'filebrowserImageUploadUrl'=>Yii::app()->baseUrl.'/kcfinder/upload.php?type=images',
                    'filebrowserUploadUrl'=>Yii::app()->baseUrl.'/kcfinder/upload.php?type=files',
                ));
            ?>  
          <div class="help-inline">
                <?php echo $form->error($model,'content_'.$language->code); ?>
          </div>
        </div>
      </div>
      
</div> <!-- form -->