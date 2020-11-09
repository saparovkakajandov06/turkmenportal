<?php
/* @var $this ContactController */
/* @var $model Contact */
/* @var $form CActiveForm */
?>

<div class="form wide">

<?php 
$model=new Contact();

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
        'action'=>Yii::app()->createUrl('//contact/createQuick'),
	'enableAjaxValidation'=>true,
)); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone');  ?>
		<?php echo $form->textField($model,'phone',array('size'=>60,'maxlength'=>250,'class'=>'validate_number')); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comments'); ?>
		<?php echo $form->textArea($model,'comments',array('style'=>'width: 190px; height: 65px;')); ?>
		<?php echo $form->error($model,'comments'); ?>
	</div>

    
	<div class="row buttons">
		<?php echo CHtml::submitButton('Send'); ?>
	</div>

<?php $this->endWidget(); ?>
</div>