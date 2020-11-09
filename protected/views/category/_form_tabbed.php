<div class="wide form">
    
    <div class="control-group">
        <?php echo $form->labelEx($model,'parent_id',array('class'=>'control-label')) ; ?>
        <div class="controls">
            <?php 
            $this->widget('CAutoComplete', array(
                'name' => "parent_auto_complete",
                'value' => $model->getParentInheritance(false),
                'url'=>Yii::app()->createUrl('//category/autocomplete'),
                'multiple'=>false,
                'mustMatch'=>false,
                'matchCase'=>false,
                'max'=>50, 
                'minChars'=>1, 
                'delay'=>20, 
                'textArea'=>false,
                'autoFill'=>true,
//                'htmlOptions'=>array('size'=>'40'),
                'methodChain'=>".result(function(event,item){\$(\".parent_id\").val(item[1]);})",
 	                  
            )); ?>
        </div> 
        
        <?php echo $form->hiddenField($model, 'parent_id',array('class'=>"parent_id")); ?>
        <div class="help-inline">
                <?php echo $form->error($model,'parent_id'); ?>
        </div>
    </div> 
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'related_category_id',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->dropDownList($model,'related_category_id',  Category::model()->getParentCategoriesList(),array('empty'=>"")); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'related_category_id'); ?>
          </div>
        </div>
      </div>
    
      
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'url_prefix',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'url_prefix'); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'url_prefix'); ?>
          </div>
        </div>
      </div>
        
        
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
        <?php echo $form->labelEx($model,'sort_order',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'sort_order'); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'sort_order'); ?>
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
        <?php echo $form->labelEx($model,'status',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->checkBox($model,'status'); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'status'); ?>
          </div>
        </div>
      </div>
</div> <!-- form -->