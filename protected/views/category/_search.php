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
    <?php echo $form->labelEx($model,'image',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'image',array('size'=>60,'maxlength'=>255));
if (!empty($model->image)){ ?> <div class="right"><a href="<?php echo $model->image ?>" target="_blank" title="<?php echo Awecms::generateFriendlyName('image') ?>"><img src="<?php echo $model->image ?>"  alt="<?php echo Awecms::generateFriendlyName('image') ?>" title="<?php echo Awecms::generateFriendlyName('image') ?>"/></a></div><?php }; ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'parent_id',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'parent_id'); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'top',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->checkBox($model,'top'); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'column',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'column'); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'sort_order',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'sort_order'); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'status',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->checkBox($model,'status'); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'date_added',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php $this->widget('CJuiDateTimePicker',
                         array(
                            'model'=>$model,
                                                        'name'=>'Category[date_added]',
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
                                                        'name'=>'Category[date_modified]',
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