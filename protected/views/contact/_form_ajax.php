<?php
/* @var $this ContactController */
/* @var $model Contact */
/* @var $form CActiveForm */
?>

<div class="form wide input_250" style="margin-left: 25px; margin-top: 25px;">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableAjaxValidation'=>true,
        'action'=>Yii::app()->createUrl('//contact/createAjax'),

)); ?>
    
	<p class="note"> Fields with <span class="required">*</span>  are required.</p>

	<?php echo $form->errorSummary($model); ?>
        <div class="horizontal_divider"></div>
	<div class="row">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'company_name'); ?>
		<?php echo $form->textField($model,'company_name',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'company_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->textField($model,'country',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'country'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fax'); ?>
		<?php echo $form->textField($model,'fax',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'fax'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comments'); ?>
		<?php echo $form->textArea($model,'comments',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comments'); ?>
	</div>


	
        <div class="form-actions">
            <?php

            echo CHtml::ajaxSubmitButton(Yii::t('app','$LNG_ADD'),CHtml::normalizeUrl(array('//cantact/createAjax','render'=>false)),
                array('success'=>'js:function(data){
                        console.log(data);
                         var data = $.parseJSON(data);
                         if(data.status=="success"){
                         alert("success");
//                              $("#Comments_text").val("");
                        }
                        else
                        {
                            alert(data.message);
                        }
                    }'),

                array('id'=>'comments_adddd'.uniqid(),'class'=>"btn btn-success")
                ); 
            ?>
        </div>
<?php $this->endWidget(); ?>

</div><!-- form -->