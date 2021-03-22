<?php
/* @var $this InfoCitiesController */
/* @var $model InfoCities */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'info-cities-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <div class="inner-tab">
        <div class="col-xs-12">

            <?php
            $tabs = array();
            $actived = true;
            $languages = Language::model()->findAllByAttributes(array('status' => 1));
            foreach ($languages as $language) {
                $tabs[] = array(
                        'id' => $key,
                    'label' => $language->name,
                    'content' => $this->renderPartial('_form_description',
                        array('model' => $model, 'language' => $language, 'form' => $form),
                        true,
                        false
                    ),
                    'active' => $actived);
                if ($actived == true)
                    $actived = false;
            }

            $this->widget('bootstrap.widgets.TbTabs', array(
                "id" => "blog-inner-form-tabs",
                "type" => "tabs",
                'tabs' => $tabs
            ));
            ?>
        </div>
    </div>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'citi_name'); ?>
		<?php echo $form->textField($model,'citi_name',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'citi_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'state'); ?>
		<?php echo $form->textField($model,'state',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'state'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->textField($model,'country',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'country'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lon'); ?>
		<?php echo $form->textField($model,'lon',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'lon'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lat'); ?>
		<?php echo $form->textField($model,'lat',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'lat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'visibility'); ?>
		<?php echo $form->checkBox($model,'visibility'); ?>
		<?php echo $form->error($model,'visibility'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->checkBox($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

    <?php $this->endWidget(); ?>

</div><!-- form -->