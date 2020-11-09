<div class="wide form">
    <p class="note">
        <?php echo Yii::t('app','Fields with');?> <span class="required">*</span> <?php echo Yii::t('app','are required');?>.
    </p>

    
      <div class="control-group">
        <?php echo $form->labelEx($model,'region_id',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'region_id',array('size'=>20,'maxlength'=>20)); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'region_id'); ?>
          </div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'category_id',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'category_id',array('size'=>11,'maxlength'=>11)); ?>
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
          <?php echo $form->checkBox($model,'type'); ?>
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
        <?php echo $form->labelEx($model,'price',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'price',array('size'=>60,'maxlength'=>255)); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'price'); ?>
          </div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'rating',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'rating',array('size'=>60,'maxlength'=>255)); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'rating'); ?>
          </div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'period',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php $this->widget('CJuiDateTimePicker',
                         array(
                            'model'=>$model,
                                                        'name'=>'Estates[period]',
                            //'language'=> substr(Yii::app()->language,0,strpos(Yii::app()->language,'_')),
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
                    ; ?>
          <div class="help-inline">
                <?php echo $form->error($model,'period'); ?>
          </div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'views',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'views',array('size'=>10,'maxlength'=>10)); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'views'); ?>
          </div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'likes',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'likes',array('size'=>10,'maxlength'=>10)); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'likes'); ?>
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
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'edited_username',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'edited_username',array('size'=>60,'maxlength'=>255)); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'edited_username'); ?>
          </div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'create_username',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'create_username',array('size'=>60,'maxlength'=>255)); ?>
          <div class="help-inline">
                <?php echo $form->error($model,'create_username'); ?>
          </div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'date_added',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php $this->widget('CJuiDateTimePicker',
                         array(
                            'model'=>$model,
                                                        'name'=>'Estates[date_added]',
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
          <div class="help-inline">
                <?php echo $form->error($model,'date_added'); ?>
          </div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'date_modified',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php $this->widget('CJuiDateTimePicker',
                         array(
                            'model'=>$model,
                                                        'name'=>'Estates[date_modified]',
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
          <div class="help-inline">
                <?php echo $form->error($model,'date_modified'); ?>
          </div>
        </div>
      </div>
        </div> <!-- form -->