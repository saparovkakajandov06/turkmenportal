<div class="wide form">

<?php $form = $this->beginWidget('CActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

  <div class="control-group">
    <?php echo $form->labelEx($model,'id',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'id'); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'last_name',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'last_name',array('size'=>60,'maxlength'=>250)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'first_name',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>255)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'company_name',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'company_name',array('size'=>60,'maxlength'=>250)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'address',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>255)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'city',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'city',array('size'=>60,'maxlength'=>255)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'country',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'country',array('size'=>60,'maxlength'=>255)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'email',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>250)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'phone',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'phone',array('size'=>60,'maxlength'=>250)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'fax',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'fax',array('size'=>60,'maxlength'=>255)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'comments',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textArea($model,'comments',array('rows'=>6, 'cols'=>50)); ?>
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
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'edited_username',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'edited_username',array('size'=>60,'maxlength'=>255)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'create_username',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'create_username',array('size'=>60,'maxlength'=>255)); ?>
    </div>
  </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->