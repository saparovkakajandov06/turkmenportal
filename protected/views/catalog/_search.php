<div class="wide form">

<?php $form = $this->beginWidget('CActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

  <div class="control-group">
    <?php echo $form->labelEx($model,'id',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'id',array('size'=>20,'maxlength'=>20)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'region_id',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'region_id',array('size'=>20,'maxlength'=>20)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'category_id',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'category_id',array('size'=>20,'maxlength'=>20)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'address',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>255)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'phone',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'phone',array('size'=>60,'maxlength'=>255)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'mail',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'mail',array('size'=>60,'maxlength'=>255)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'web',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'web',array('size'=>60,'maxlength'=>255)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'rating',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'rating',array('size'=>60,'maxlength'=>255)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'period',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php $this->widget('CJuiDateTimePicker',
                         array(
                            'model'=>$model,
                                                        'name'=>'Catalog[period]',
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
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'views',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'views',array('size'=>10,'maxlength'=>10)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'likes',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'likes',array('size'=>10,'maxlength'=>10)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'status',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->checkBox($model,'status'); ?>
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

  <div class="control-group">
    <?php echo $form->labelEx($model,'date_added',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php $this->widget('CJuiDateTimePicker',
                         array(
                            'model'=>$model,
                                                        'name'=>'Catalog[date_added]',
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
                                                        'name'=>'Catalog[date_modified]',
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

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->