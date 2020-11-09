<div class="wide form">
    <?php
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'estates-form',
        'enableAjaxValidation'=>false,
        'action'=>Yii::app()->createUrl('//estates/generalCreate'),
        'enableClientValidation'=>true,
    ));

    echo $form->errorSummary($model);
    ?>
    
    
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
        <?php echo $form->labelEx($model,'category_id',array('class'=>'control-label')) ; ?>
        <div class="controls">
            <?php echo $form->dropDownList($model, 'category_id', CategoryDescription::model()->getListByParentId($model->catalog_category_id), array('prompt' => "", 'id' => "sub_category_id")); ?>
            <?php //echo $form->dropDownList($model, 'category_id', CategoryDescription::model()->getListByParentCode('estates'), array('prompt' => "")); ?>
          <div class="help-inline">
            <?php echo $form->error($model,'category_id'); ?>
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
        <?php echo $form->labelEx($model,'type',array('class'=>'control-label')) ; ?>
        <div class="controls">
            <?php echo $form->dropDownList($model,'type', $model->getTypeOptions(), array('class'=>'')); ?>      
          <div class="help-inline">
            <?php echo $form->error($model,'type'); ?>
          </div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'room',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'room',array('size'=>10,'maxlength'=>10)); ?>
          <div class="help-inline">
            <?php echo $form->error($model,'room'); ?>
          </div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'year',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'year',array('size'=>60,'maxlength'=>255)); ?>
          <div class="help-inline">
            <?php echo $form->error($model,'year'); ?>
          </div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'meter',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'meter',array('size'=>60,'maxlength'=>255)); ?>
          <div class="help-inline">
            <?php echo $form->error($model,'meter'); ?>
          </div>
        </div>
      </div>
    
    <div class="control-group">
        <?php echo $form->labelEx($descriptionModel, 'description', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textArea($descriptionModel, 'description', array('size' => 60, 'maxlength' => 255)); ?>
            <div class="help-inline">
                <?php echo $form->error($descriptionModel, 'description'); ?>
            </div>
        </div>
    </div>
    
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'price',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'price',array('size'=>60,'maxlength'=>255)); ?>
          <div class="help-inline">
            <?php echo $form->error($model,'price'); ?>
          </div>
        </div>
      </div>
    
    
     <div class="control-group">
            <?php echo CHtml::label(Yii::t('app','image'),'', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php
                    if(isset ($photos))
                    {
                        $this->widget( 'XUpload', array(
                            'url' => Yii::app()->createUrl("//site/upload",array('state_name'=>'state_estates')),
                            //our XUploadForm
                            'model' => $photos,
                            //We set this for the widget to be able to target our own form
                            'htmlOptions' => array('id'=>'estates-form'),
                            'attribute' => 'file',
                            'multiple' => true,
                            'autoUpload'=>true,
                            'showForm' => false,
            //                            'maxNumberOfFiles'=>10
                            )    
                        );
                    }
                 ?>
            </div>
      </div>
    
    
  <div class="horizontal_divider"></div>
  <div class="form-actions">
    <?php
//        echo CHtml::submitButton(Yii::t('app', 'Save'),array('class'=>'btn btn-success'));
        echo CHtml::ajaxSubmitButton(Yii::t('app','$LNG_ADD'),CHtml::normalizeUrl(array('//estates/generalCreate','render'=>false)),
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
                }'
            ),
            array('id'=>'close_auto_create_dialog'.uniqid(),'class'=>"btn btn-success")
        ); 
        
        echo '&nbsp;';
        echo CHtml::Button(Yii::t('app', 'Cancel'), array(
			                                                'submit' => 'javascript:history.go(-1)',
			                                                'class'  => 'btn btn-inverse'
			                                                )
			                                              );
        $this->endWidget(); ?>
  </div>
</div> <!-- form -->