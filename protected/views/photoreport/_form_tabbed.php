<div class="wide form">
    <p class="note">
        <?php echo Yii::t('app','Fields with');?> <span class="required">*</span> <?php echo Yii::t('app','are required');?>.
    </p>

    
    <div class="control-group">
        <?php echo $form->labelEx($model,'category_id',array('class'=>'control-label')) ; ?>
        <div class="controls">
            <?php echo $form->dropDownList($model, 'category_id', Category::model()->getListByParentId($model->blog_category_id), array('id'=>"sub_category_id")); ?>
          <div class="help-inline">
            <?php echo $form->error($model,'category_id'); ?>
          </div>
        </div>
      </div>
    
    
     
    <div class="control-group">
        <label for="regions"><?php echo Yii::t('app', 'Regions'); ?></label>
        <div class="controls">
        <div class="row nm_row nm_regions">
            <?php 
                echo CHtml::checkBoxList(
                            'Blog[regions]', 
                            array_keys(CHtml::listData($model->regions,'id','id')),
                            Regions::model()->getRegionsListByTree(),
                            array('template'=>"{beginLabel} {input} {labelTitle} {endLabel} ",  
                                'attributeitem' => 'id', 
                                'labelOptions'=>array('style'=>'display:inline')
                                )
                            ); 
            ?>
        </div>
        <a class="select_all" onclick="$(this).parent().find('.nm_regions :checkbox').attr('checked', true);"><?php echo Yii::t('app',"Select All"); ?></a>/
        <a class="select_none" onclick="$(this).parent().find('.nm_regions :checkbox').attr('checked', false);"><?php echo Yii::t('app',"Select None"); ?></a>
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
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'is_photoreport',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->checkBox($model,'is_photoreport'); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'is_photoreport'); ?>
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
        <?php echo $form->labelEx($model,'web',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'web'); ?>
          <div class="help-inline">
            <?php echo $form->error($model,'web'); ?>
          </div>
        </div>
      </div>
    
</div> <!-- form -->
