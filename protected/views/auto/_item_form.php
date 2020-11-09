<div id="itemForm">
    
    
    
    <div class="control-group">
        <?php echo CHtml::activelabelEx($model, 'make_id', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo CHtml::activedropDownList($model, 'make_id', CHtml::listData(AutoMakes::model()->findAll(), 'id', 'name'),array('prompt'=>Yii::t('app','$LNG_CHOOSE_ONE'), 
                                                                                                                                            'class'=>"make_id", 
                                                                                                                                            'ajax' => array(
                                                                                                                                                            'type'=>'POST', //request type
                                                                                                                                                            'url'=>CController::createUrl('autoModels/dynamicModels'), //url to call.
//                                                                                                                                                            'update'=>'#auto_model_id', //selector to update
                                                                                                                                                            'data'=>'js:jQuery(this).parents("form").serialize()',
                                                                                                                                                            'success'=>'js:function(data){  if(typeof data!=="undefined" && data.length>0){ $("#auto_model_id").show(200); $("#auto_model_id").html(data);}else{$("#auto_model_id").hide(200); $("#auto_model_id").val(""); } }',
                                                                                                                                                            )
                                                                                                                                                )); ?>
            
                        <?php echo CHtml::activedropDownList($model, 'model_id', CHtml::listData(AutoModels::model()->findAllByAttributes(array('make_id'=>$model->make_id)), 'id', 'name'),array('style'=> strlen($model->model_id)>0 ? "":'display:none','id'=>"auto_model_id",'prompt'=>Yii::t('app','$LNG_CHOOSE_ONE'))); ?>

            <div class="help-inline">
                <?php echo CHtml::error($model, 'make_id'); ?>
            </div>
        </div>
    </div>
    
    
    <div class="control-group">
        <?php echo CHtml::activelabelEx($model, 'year', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php
                $year_list=array();
                $this_year=(int)date('Y');
                for($i=$this_year; $i>=1970; $i--){
                    $year_list[$i]=$i;
                }
            ?>
            <?php echo CHtml::activedropDownList($model, 'year',$year_list,array('prompt'=>Yii::t('app','$LNG_CHOOSE_ONE'))); ?>
            <div class="help-inline">
                <?php echo CHtml::error($model, 'year'); ?>
            </div>
        </div>
    </div>
    
    <div class="control-group">
        <?php echo CHtml::activelabelEx($model, 'bodytype', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo CHtml::activedropDownList($model, 'bodytype',$model->getBodyTypeOptions(),array('prompt'=>Yii::t('app','$LNG_CHOOSE_ONE'))); ?>
            <div class="help-inline">
                <?php echo CHtml::error($model, 'bodytype'); ?>
            </div>
        </div>
    </div>
    
    <div class="control-group ">
        <?php echo CHtml::activelabelEx($model, 'auto_condition', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo CHtml::activeRadioButtonList($model, 'auto_condition', $model->getAutoConditionOptions(),array('container'=>'ul','template'=>"<li class=\"radio-inline\">{input}{label}</li>","separator"=>"")); ?>
            <div class="help-inline">
                <?php echo CHtml::error($model, 'auto_condition'); ?>
            </div>
        </div>
    </div>
    

    <div class="control-group">
        <?php echo CHtml::activelabelEx($model, 'trip', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo CHtml::activetextField($model, 'trip', array('size' => 60, 'maxlength' => 255,'class'=>'mini_input')); ?>
            <?php echo CHtml::activeRadioButtonList($model, 'odometer_unit', $model->getOdometerUnitOptions(),array('container'=>'ul','template'=>"<li class=\"radio-inline\">{input}{label}</li>","separator"=>"")); ?>
            <div class="help-inline">
                <?php echo CHtml::error($model, 'trip'); ?>
            </div>
        </div>
    </div>
  
    <div class="control-group">
        <?php echo CHtml::activelabelEx($model, 'color', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo CHtml::activedropDownList($model, 'color',$model->getColorOptions(),array('prompt'=>Yii::t('app','$LNG_CHOOSE_ONE'))); ?>
            <div class="help-inline">
                <?php echo CHtml::error($model, 'color'); ?>
            </div>
        </div>
    </div>
    
    
    <div class="control-group">
        <?php echo CHtml::activelabelEx($model, 'engine_capacity', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo CHtml::activetextField($model, 'engine_capacity', array('size' => 60, 'maxlength' => 255,'class'=>'validate_number mini_input'));  ?> <span><?php  echo Yii::t('app', 'litr'); ?></span>
            <div class="help-inline">
                <?php echo CHtml::error($model, 'engine_capacity'); ?>
            </div>
        </div>
    </div>
    
  
   
    <div class="control-group ">
        <?php echo CHtml::activelabelEx($model, 'transmission', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo CHtml::activeRadioButtonList($model, 'transmission', $model->getTransmissionOptions(),array('container'=>'ul','template'=>"<li class=\"radio-inline\">{input}{label}</li>","separator"=>"")); ?>
            <div class="help-inline">
                <?php echo CHtml::error($model, 'transmission'); ?>
            </div>
        </div>
    </div>
    
    
    <div class="control-group ">
        <?php echo CHtml::activelabelEx($model, 'drivetrain', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo CHtml::activeRadioButtonList($model, 'drivetrain', $model->getDrivetrainOptions(),array('container'=>'ul','template'=>"<li class=\"radio-inline\">{input}{label}</li>","separator"=>"")); ?>
            <div class="help-inline">
                <?php echo CHtml::error($model, 'drivetrain'); ?>
            </div>
        </div>
    </div>
    
    <div class="control-group ">
        <?php echo CHtml::activelabelEx($model, 'other_options', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo CHtml::activeCheckBoxList($model, 'other_options', $model->getOtherOptions(),array('container'=>'ul','template'=>"<li class=\"checkbox-inline\">{input}{label}</li>","separator"=>"")); ?>
            <div class="help-inline">
                <?php echo CHtml::error($model, 'other_options'); ?>
            </div>
        </div>
    </div>
   
   
   
    <div class="control-group">
        <?php echo CHtml::activelabelEx($model, 'price', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo CHtml::activetextField($model, 'price', array('size' => 60, 'maxlength' => 255,'class'=>"mini_input")); ?>
            <?php echo CHtml::activeRadioButtonList($model, 'currency', ItemForm::getCurrencyOptions(),array('container'=>'ul','template'=>"<li class=\"radio-inline\">{input}{label}</li>","separator"=>"")); ?>
            <div class="help-inline">
                <?php echo CHtml::error($model, 'price'); ?>
            </div>
        </div>
    </div>
    
   

</div>
    
