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
    <?php echo $form->labelEx($model,'language_id',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'language_id',array('size'=>11,'maxlength'=>11)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'estates_id',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'estates_id',array('size'=>11,'maxlength'=>11)); ?>
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