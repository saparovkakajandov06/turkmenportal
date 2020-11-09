<div class="form">

    <?php
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'documents-form',
        'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
    ));

    echo $form->errorSummary($model);
    ?>

        
      <div class="control-group">
        <?php echo $form->labelEx($model,'title',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'title'); ?>
          <?php echo $form->hiddenField($model,'name'); ?>
          <?php echo $form->hiddenField($model,'state_name'); ?>
          <div class="help-inline">
            <?php echo $form->error($model,'title'); ?>
          </div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'alt',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'alt'); ?>
          <div class="help-inline">
            <?php echo $form->error($model,'alt'); ?>
          </div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'caption',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textArea($model,'caption'); ?>
          <div class="help-inline">
            <?php echo $form->error($model,'caption'); ?>
          </div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'author',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'author'); ?>
          <div class="help-inline">
            <?php echo $form->error($model,'author'); ?>
          </div>
        </div>
      </div>
      <div class="control-group">
        <?php echo $form->labelEx($model,'is_main',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->checkBox($model,'is_main'); ?>
          <div class="help-inline">
            <?php echo $form->error($model,'is_main'); ?>
          </div>
        </div>
      </div>
        
     
     <div class="form-actions">
                <?php 
                
                echo CHtml::ajaxSubmitButton(Yii::t('app','Save'),CHtml::normalizeUrl(array('//documents/editDialog','render'=>false)),
                        array(
                            'success'=>'js:function(data){
                                var data = $.parseJSON(data);
                                console.log(data);
                                $(".ui-dialog-titlebar-close").trigger("click");
                            }',
                            ),

                        array('id'=>'close_edit_dialog'.uniqid(),'class'=>"btn btn-success")
                        ); 
                
                
               echo CHtml::link(
                    Yii::t('app','$LNG_CANCEL'), 
                    '#', 
                    array(
                        'return'=>'false',
                        'onclick'=>'
                             $(".ui-dialog-titlebar-close").trigger("click");
                             return false;
                            ',
                        'class'=>'form_cancel',
                    )
                );
                    ?>
	</div>

  
        <?php $this->endWidget(); ?>
</div> <!-- form -->