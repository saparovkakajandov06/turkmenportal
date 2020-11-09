<div class="form">
    <p class="note">
        <?php echo Yii::t('app','Fields with');?> <span class="required">*</span> <?php echo Yii::t('app','are required');?>.
    </p>

    <?php
    $form=$this->beginWidget('CActiveForm', array(
    'id'=>'contact-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    ));

    echo $form->errorSummary($model);
    ?>
    
      <div class="control-group">
        <?php echo $form->labelEx($model,'last_name',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'last_name',array('size'=>60,'maxlength'=>250)); ?>
          <div class="help-inline"><?php echo $form->error($model,'last_name'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'first_name',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>255)); ?>
          <div class="help-inline"><?php echo $form->error($model,'first_name'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'company_name',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'company_name',array('size'=>60,'maxlength'=>250)); ?>
          <div class="help-inline"><?php echo $form->error($model,'company_name'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'address',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>255)); ?>
          <div class="help-inline"><?php echo $form->error($model,'address'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'city',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'city',array('size'=>60,'maxlength'=>255)); ?>
          <div class="help-inline"><?php echo $form->error($model,'city'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'country',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'country',array('size'=>60,'maxlength'=>255)); ?>
          <div class="help-inline"><?php echo $form->error($model,'country'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'email',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>250)); ?>
          <div class="help-inline"><?php echo $form->error($model,'email'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'phone',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'phone',array('size'=>60,'maxlength'=>250)); ?>
          <div class="help-inline"><?php echo $form->error($model,'phone'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'fax',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'fax',array('size'=>60,'maxlength'=>255)); ?>
          <div class="help-inline"><?php echo $form->error($model,'fax'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'comments',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textArea($model,'comments',array('rows'=>6, 'cols'=>50)); ?>
          <div class="help-inline"><?php echo $form->error($model,'comments'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'date_added',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php $this->widget('CJuiDateTimePicker',
                         array(
                            'model'=>$model,
                                                        'name'=>'Contact[date_added]',
                            //'language'=> substr(Yii::app()->language,0,strpos(Yii::app()->language,'_')),
                                                        'language'=> '',
                            'value'=>$model->date_added,
                                                        'mode' => 'datetime',
                            'options'=>array(
                                                                        'showAnim'=>'fold', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
                                                                        'showButtonPanel'=>true,
                                                                        'changeYear'=>true,
                                                                        'changeMonth'=>true,
                                                                        'dateFormat'=>'yy-mm-dd',
                                                                        ),
                                                    )
                    );
                    ; ?>
          <div class="help-inline"><?php echo $form->error($model,'date_added'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'date_modified',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php $this->widget('CJuiDateTimePicker',
                         array(
                            'model'=>$model,
                                                        'name'=>'Contact[date_modified]',
                            //'language'=> substr(Yii::app()->language,0,strpos(Yii::app()->language,'_')),
                                                        'language'=> '',
                            'value'=>$model->date_modified,
                                                        'mode' => 'datetime',
                            'options'=>array(
                                                                        'showAnim'=>'fold', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
                                                                        'showButtonPanel'=>true,
                                                                        'changeYear'=>true,
                                                                        'changeMonth'=>true,
                                                                        'dateFormat'=>'yy-mm-dd',
                                                                        ),
                                                    )
                    );
                    ; ?>
          <div class="help-inline"><?php echo $form->error($model,'date_modified'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'edited_username',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'edited_username',array('size'=>60,'maxlength'=>255)); ?>
          <div class="help-inline"><?php echo $form->error($model,'edited_username'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'create_username',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'create_username',array('size'=>60,'maxlength'=>255)); ?>
          <div class="help-inline"><?php echo $form->error($model,'create_username'); ?>
</div>
        </div>
      </div>
        
  <div class="form-actions">
    <?php
        echo CHtml::submitButton(Yii::t('app', 'Save'),array('class'=>'btn btn-success'));
        echo '&nbsp;';
        echo CHtml::Button(Yii::t('app', 'Cancel'), array(
			                                                'submit' => 'javascript:history.go(-1)',
			                                                'class'  => 'btn btn-inverse'
			                                                )
			                                              );
        $this->endWidget(); ?>
  </div>
</div> <!-- form -->