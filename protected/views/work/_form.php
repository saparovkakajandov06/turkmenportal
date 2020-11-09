<div class="wide form">
    <?php
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'employees-form',
        'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'action'=>Yii::app()->createUrl('//employees/generalCreate'),
    ));

    echo $form->errorSummary($model);
    ?>
    



        <div class="control-group">
            <?php echo $form->labelEx($model, 'title', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($model, 'title', array('size' => 60)); ?>
                <div class="help-inline">
                    <?php echo $form->error($model, 'title'); ?>
                </div>
            </div>

        </div><div class="control-group">
            <?php echo $form->labelEx($model, 'description', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textArea($model, 'description', array('style' => 'height:85px')); ?>
                <div class="help-inline">
                    <?php echo $form->error($model, 'description'); ?>
                </div>
            </div>
        </div>


        <div class="control-group">
            <?php echo $form->labelEx($model, 'experience', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($model, 'experience', array('size' => 60,'class'=>'long_text_field')); ?>
                <div class="help-inline">
                    <?php echo $form->error($model, 'experience'); ?>
                </div>
            </div>
        </div>
    
        <div class="control-group">
            <?php echo $form->labelEx($model, 'computer_experience', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($model, 'computer_experience',array('class'=>'long_text_field')); ?>
                <div class="help-inline">
                    <?php echo $form->error($model, 'computer_experience'); ?>
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
        <?php echo $form->labelEx($model,'profession_id',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->dropDownList($model, 'profession_id', CHtml::listData(Professions::model()->findAll(),'id','name'), array('prompt' => "")); ?>
          <div class="help-inline">
            <?php echo $form->error($model,'profession_id'); ?>
          </div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'branch_id',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->dropDownList($model, 'branch_id', CHtml::listData(Branches::model()->findAllByAttributes(array('language_id'=>Yii::app()->session['current_lang_id']) ),'id','name'), array('prompt' => "")); ?>
          <div class="help-inline">
            <?php echo $form->error($model,'branch_id'); ?>
          </div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'education',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->dropDownList($model,'education',  Employees::model()->getEducationTypes(),array('prompt' => "")); ?>
          <div class="help-inline">
            <?php echo $form->error($model,'education'); ?>
          </div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'languages',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'languages',array('size'=>60,'maxlength'=>255)); ?>
          <div class="help-inline">
            <?php echo $form->error($model,'languages'); ?>
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
    
       
    
<div class="horizontal_divider"></div>

  <div class="form-actions">
    <?php
           echo CHtml::ajaxSubmitButton(Yii::t('app','$LNG_ADD'),CHtml::normalizeUrl(array('//employees/generalCreate','render'=>false)),
                array('success'=>'js:function(data){
                        var data = $.parseJSON(data);
                        if(data.status=="success"){
                            if (confirm(data.message)) {
                                location.href=data.redirect;
                            }else{
                                clientFormReset();
                            }
                        }
                        else
                        {
                            if (data.message.indexOf("{")==0) {
                               e = jQuery.parseJSON(data.message);
                               jQuery.each(e, function(key, value) { jQuery("#"+key+"_em_").show().html(value.toString()); });
                            }
                        }
                    }'),

                array('id'=>'close_employees_create_dialog'.uniqid(),'class'=>"btn btn-success")
                ); 
            
        
//                echo CHtml::submitButton(Yii::t('app', 'Save'),array('class'=>'btn btn-success'));
        echo '&nbsp;';
        echo CHtml::Button(Yii::t('app', 'Cancel'), array(
        'submit' => 'javascript:history.go(-1)',
        'class'  => 'btn btn-inverse'
        )
      );
        $this->endWidget(); ?>
  </div>
</div> <!-- form -->