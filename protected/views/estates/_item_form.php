  <div id="itemForm">

    <div class="control-group">
        <?php echo CHtml::activelabelEx($model,'type',array('class'=>'control-label')) ; ?>
        <div class="controls">
            <?php echo CHtml::activedropDownList($model,'type', $model->getTypeOptions(), array('class'=>'')); ?>      
          <div class="help-inline">
            <?php echo  CHtml::error($model,'type'); ?>
          </div>
        </div>
      </div>

       <div class="control-group price_combined">
            <?php echo CHtml::activelabelEx($model, 'price', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo CHtml::activetextField($model, 'price', array('size' => 60, 'maxlength' => 255,'class'=>"mini_input")); ?>
                <?php echo CHtml::activeRadioButtonList($model, 'currency', ItemForm::getCurrencyOptions(),array('container'=>'ul','template'=>"<li class=\"radio-inline\">{input}{label}</li>","separator"=>"")); ?>
                <div class="help-inline">
                    <?php echo CHtml::error($model, 'price'); ?>
                </div>
            </div>
        </div>
    
        
    
        
      <div class="control-group">
        <?php echo CHtml::activelabelEx($model,'room',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo CHtml::activedropDownList($model,'room',$model->getRoomOptions(), array('class'=>'')); ?>
          <div class="help-inline">
            <?php echo  CHtml::error($model,'room'); ?>
          </div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo CHtml::activelabelEx($model,'year',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo CHtml::activetextField($model,'year',array('size'=>60,'maxlength'=>255)); ?>
          <div class="help-inline">
            <?php echo  CHtml::error($model,'year'); ?>
          </div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo CHtml::activelabelEx($model,'meter',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo CHtml::activetextField($model,'meter',array('size'=>60,'maxlength'=>255)); ?>
          <div class="help-inline">
            <?php echo  CHtml::error($model,'meter'); ?>
          </div>
        </div>
      </div>
      </div>
    
  