<div class="wide form">

<?php $form = $this->beginWidget('CActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

  <div class="control-group">
    <?php echo $form->labelEx($model,'id',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'id',array('size'=>11,'maxlength'=>11)); ?>
    </div>
  </div>

 

  <div class="control-group">
    <?php echo $form->labelEx($model,'category_id',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'category_id'); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'tmp_cat_name',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'tmp_cat_name',array('size'=>60,'maxlength'=>255)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'title_ru',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'title_ru',array('size'=>60,'maxlength'=>255)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'title_tm',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'title_tm',array('size'=>60,'maxlength'=>255)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'content_ru',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textArea($model,'content_ru',array('rows'=>6, 'cols'=>50)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'content_tm',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textArea($model,'content_tm',array('rows'=>6, 'cols'=>50)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'web',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'web',array('size'=>60,'maxlength'=>255)); ?>
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
    <?php echo $form->labelEx($model,'dislikes',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'dislikes'); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'date_added',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php $this->widget('CJuiDateTimePicker',
                         array(
                            'model'=>$model,
                                                        'name'=>'Compositions[date_added]',
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
                                                        'name'=>'Compositions[date_modified]',
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

  <div class="control-group">
    <?php echo $form->labelEx($model,'status',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->checkBox($model,'status'); ?>
    </div>
  </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->