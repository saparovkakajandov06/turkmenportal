<div id="itemForm">
    
       

        
      <div class="control-group">
        <?php echo CHtml::activelabelEx($model,'profession_id',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo CHtml::activedropDownList($model, 'profession_id', CHtml::listData(Professions::model()->findAll(array('order'=>'name')),'id','name'), array('prompt' => "")); ?>
          <div class="help-inline">
            <?php echo CHtml::error($model,'profession_id'); ?>
          </div>
        </div>
      </div>
<!--        -->
<!--      <div class="control-group">-->
<!--        --><?php //echo CHtml::activelabelEx($model,'branch_id',array('class'=>'control-label')) ; ?>
<!--        <div class="controls">-->
<!--          --><?php //echo CHtml::activedropDownList($model, 'branch_id', CHtml::listData(Branches::model()->findAllByAttributes(array('language_id'=>Yii::app()->session['current_lang_id']) ),'id','name'), array('prompt' => "")); ?>
<!--          <div class="help-inline">-->
<!--            --><?php //echo CHtml::error($model,'branch_id'); ?>
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->
        
      <div class="control-group">
        <?php echo CHtml::activelabelEx($model,'education',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo CHtml::activedropDownList($model,'education',  Work::model()->getEducationTypes(),array('prompt' => "")); ?>
          <div class="help-inline">
            <?php echo CHtml::error($model,'education'); ?>
          </div>
        </div>
      </div>

    <div class="control-group">
        <?php echo CHtml::activelabelEx($model,'schedule',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo CHtml::activedropDownList($model,'schedule',  Work::model()->getScheduleOptions(),array('prompt' => "")); ?>
          <div class="help-inline">
            <?php echo CHtml::error($model,'schedule'); ?>
          </div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo CHtml::activelabelEx($model, 'experience', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo CHtml::activedropDownList($model, 'experience', Work::model()->getExperienceOptions(), array('prompt' => "",'class' => 'mini_input')); ?>
            <?php echo CHtml::label(Yii::t('app','year_old'),'',array('class'=>'inline-label')); ?>
            <div class="help-inline">
                <?php echo CHtml::error($model, 'experience'); ?>
            </div>
        </div>
    </div>
    
    
    <div class="control-group">
        <?php echo CHtml::activelabelEx($model, 'salary', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo CHtml::activeTextField($model, 'salary', array('size' => 60,'class' => 'mini_input')); ?>
            <?php echo CHtml::activeRadioButtonList($model, 'currency', ItemForm::getCurrencyOptions(),array('container'=>'ul','template'=>"<li class=\"radio-inline\">{input}{label}</li>","separator"=>"")); ?>
            <div class="help-inline">
                <?php echo CHtml::error($model, 'salary'); ?>
            </div>
        </div>
    </div>


    
    <div class="control-group">
        <?php echo CHtml::activelabelEx($model, 'computer_experience', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo CHtml::activeTextField($model, 'computer_experience',array('class'=>'long_text_field')); ?>
            <div class="help-inline">
                <?php echo CHtml::error($model, 'computer_experience'); ?>
            </div>
        </div>
    </div>

    
    
       
    
    
    <div class="control-group">
        <?php echo CHtml::activelabelEx($model, 'languages', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo CHtml::activeTextField($model, 'languages',array('class'=>'long_text_field')); ?>
            <div class="help-inline">
                <?php echo CHtml::error($model, 'languages'); ?>
            </div>
        </div>
    </div>
    
    


</div> <!-- form -->

<?php
    Yii::app()->clientScript->registerScript('dynamicSelectww', ' 
        
        document.getElementById("item_description_label").textContent="'.Yii::t("app", "about you").'";
      
    ',  CClientScript::POS_READY);
?>