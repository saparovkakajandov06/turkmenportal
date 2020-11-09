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
    <?php echo $form->labelEx($model,'format_type',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'format_type'); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'description',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'width',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'width'); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'height',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'height'); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'type',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'type'); ?>
    </div>
  </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->