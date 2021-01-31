<?php
/* @var $this LocationsInfoController */
/* @var $model LocationsInfo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'locations-info-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'location_id'); ?>
		<?php echo $form->textField($model,'location_id'); ?>
		<?php echo $form->error($model,'location_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'continent'); ?>
		<?php echo $form->textField($model,'continent',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'continent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'country_code'); ?>
		<?php echo $form->textField($model,'country_code',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'country_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'country_flag'); ?>
		<?php echo $form->textField($model,'country_flag',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'country_flag'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'country_capital'); ?>
		<?php echo $form->textField($model,'country_capital',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'country_capital'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'country_phone'); ?>
		<?php echo $form->textField($model,'country_phone',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'country_phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'country_neighbours'); ?>
		<?php echo $form->textField($model,'country_neighbours',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'country_neighbours'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'region'); ?>
		<?php echo $form->textField($model,'region',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'region'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'asn'); ?>
		<?php echo $form->textField($model,'asn',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'asn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'org'); ?>
		<?php echo $form->textField($model,'org',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'org'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isp'); ?>
		<?php echo $form->textField($model,'isp',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'isp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'timezone'); ?>
		<?php echo $form->textField($model,'timezone',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'timezone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'timezone_name'); ?>
		<?php echo $form->textField($model,'timezone_name',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'timezone_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'timezone_gmt'); ?>
		<?php echo $form->textField($model,'timezone_gmt',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'timezone_gmt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'currency'); ?>
		<?php echo $form->textField($model,'currency',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'currency'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'currency_code'); ?>
		<?php echo $form->textField($model,'currency_code',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'currency_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'currency_symbol'); ?>
		<?php echo $form->textField($model,'currency_symbol',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'currency_symbol'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'currency_rates'); ?>
		<?php echo $form->textField($model,'currency_rates'); ?>
		<?php echo $form->error($model,'currency_rates'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->