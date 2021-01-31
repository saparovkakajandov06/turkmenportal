<?php
/* @var $this LocationsInfoController */
/* @var $model LocationsInfo */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'location_id'); ?>
		<?php echo $form->textField($model,'location_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'continent'); ?>
		<?php echo $form->textField($model,'continent',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'country_code'); ?>
		<?php echo $form->textField($model,'country_code',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'country_flag'); ?>
		<?php echo $form->textField($model,'country_flag',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'country_capital'); ?>
		<?php echo $form->textField($model,'country_capital',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'country_phone'); ?>
		<?php echo $form->textField($model,'country_phone',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'country_neighbours'); ?>
		<?php echo $form->textField($model,'country_neighbours',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'region'); ?>
		<?php echo $form->textField($model,'region',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'asn'); ?>
		<?php echo $form->textField($model,'asn',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'org'); ?>
		<?php echo $form->textField($model,'org',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'isp'); ?>
		<?php echo $form->textField($model,'isp',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'timezone'); ?>
		<?php echo $form->textField($model,'timezone',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'timezone_name'); ?>
		<?php echo $form->textField($model,'timezone_name',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'timezone_gmt'); ?>
		<?php echo $form->textField($model,'timezone_gmt',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'currency'); ?>
		<?php echo $form->textField($model,'currency',array('size'=>60,'maxlength'=>75)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'currency_code'); ?>
		<?php echo $form->textField($model,'currency_code',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'currency_symbol'); ?>
		<?php echo $form->textField($model,'currency_symbol',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'currency_rates'); ?>
		<?php echo $form->textField($model,'currency_rates'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->