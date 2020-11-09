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
    <?php echo $form->labelEx($model,'information_id',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'information_id'); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'language_id',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'language_id'); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'title',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>64)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'description',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
    </div>
  </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->