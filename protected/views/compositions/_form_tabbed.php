<div class="wide form">
    <p class="note">
        <?php echo Yii::t('app','Fields with');?> <span class="required">*</span> <?php echo Yii::t('app','are required');?>.
    </p>


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

    <div class="control-group">
        <?php echo $form->labelEx($model, 'parent_category_id', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php
            $parentCatList=Category::model()->getParentCategoriesList($model->parent_category_code_list);
            echo $form->dropDownList($model, 'parent_category_id', $parentCatList,array(
                'class'=>"category_id",
                'ajax' => array(
                    'type'=>'POST', //request type
                    'url'=>CController::createUrl('category/dynamicSubCategories'), //url to call.
                    'update'=>'#sub_category_id', //selector to update
                    'data'=>'js:jQuery(this).parents("form").serialize()'
                )
            )); ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'parent_category_id'); ?>
            </div>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model,'category_id',array('class'=>'control-label')) ; ?>
        <div class="controls">
            <?php
            if(isset($model->category_id)){
                $catList=Category::model()->getSiblingCategories($model->category_id);
            }else{
                $catList=Category::model()->getListByParentCode('compositions');
            }
            echo $form->dropDownList($model, 'category_id', $catList, array('id'=>"sub_category_id")); ?>
            <div class="help-inline">
                <?php echo $form->error($model,'category_id'); ?>
            </div>
        </div>
    </div>


    <div class="control-group">
        <?php echo $form->labelEx($model,'is_rss',array('class'=>'control-label')) ; ?>
        <div class="controls">
            <?php echo $form->checkBox($model,'is_rss'); ?>
            <div class="help-inline">
                <?php echo $form->error($model,'is_rss'); ?>
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
        <?php echo $form->labelEx($model,'views',array('class'=>'control-label')) ; ?>
        <div class="controls">
            <?php echo $form->textField($model,'views'); ?>
          <div class="help-inline">
            <?php echo $form->error($model,'views'); ?>
          </div>
        </div>
      </div>


</div> <!-- form -->
