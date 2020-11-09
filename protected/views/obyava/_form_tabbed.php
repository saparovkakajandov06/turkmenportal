<div class="wide form">
     <p class="note">
        <?php echo Yii::t('app','Fields with');?> <span class="required">*</span> <?php echo Yii::t('app','are required');?>.
     </p>
        <div class="control-group">
                <?php echo $form->labelEx($model, 'catalog_category_id', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo $form->dropDownList($model, 'catalog_category_id', Category::model()->getCatalogCategoriesList(),array('prompt'=>"", 
                                    'class'=>"catalog_category_id", 
                                    'ajax' => array(
                                                    'type'=>'POST', //request type
                                                    'url'=>CController::createUrl('category/dynamicSubCategories'), //url to call.
                                                    'update'=>'#sub_category_id', //selector to update
                                                    'data'=>'js:jQuery(this).parents("form").serialize()' 
                                                    )
                                        )); ?>
                    <div class="help-inline">
                        <?php echo $form->error($model, 'catalog_category_id'); ?>
                    </div>
                </div>
        </div>  
     
     <div class="control-group">
        <?php echo $form->labelEx($model,'category_id',array('class'=>'control-label')) ; ?>
        <div class="controls">
            <?php echo $form->dropDownList($model, 'category_id', Category::model()->getListByParentId($model->catalog_category_id), array('id'=>"sub_category_id")); ?>
          <div class="help-inline">
            <?php echo $form->error($model,'category_id'); ?>
          </div>
        </div>
      </div>
     
     
     <div class="control-group">
        <?php echo $form->labelEx($model,'region_id',array('class'=>'control-label')) ; ?>
        <div class="controls">
            <?php echo $form->dropDownList($model, 'region_id', Regions::model()->getListByParentCode('tm'), array('prompt' => "")); ?>
          <div class="help-inline">
            <?php echo $form->error($model,'region_id'); ?>
          </div>
        </div>
      </div>
        
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'address',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>255)); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'address'); ?>
          </div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'phone',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'phone',array('size'=>60,'maxlength'=>255)); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'phone'); ?>
          </div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'mail',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'mail',array('size'=>60,'maxlength'=>255)); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'mail'); ?>
          </div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'web',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'web',array('size'=>60,'maxlength'=>255)); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'web'); ?>
          </div>
        </div>
      </div>
     
    <div class="control-group">
        <?php echo $form->labelEx($model,'period',array('class'=>'control-label')) ; ?>
            <div class="controls">
            <?php 
                  $this->widget('CJuiDateTimePicker',
                      array(
                         'model'=>$model,
                         'name'=>'Catalog[period]',
                         'language'=> '',
                         'value'=>$model->period,
                         'mode' => 'date',
                         'options'=>array(
                             'showAnim'=>'fold', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
                             'showButtonPanel'=>true,
                             'changeYear'=>true,
                             'changeMonth'=>true,
                             'dateFormat'=>'yy-mm-dd',
                             ),
                         )
                 );
          ?>
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