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
    <?php echo $form->labelEx($model,'bottom',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'bottom'); ?>
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

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->