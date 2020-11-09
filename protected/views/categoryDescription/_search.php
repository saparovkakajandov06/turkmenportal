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
    <?php echo $form->labelEx($model,'category_id',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'category_id'); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'language_id',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'language_id'); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'name',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'description',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'meta_description',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'meta_description',array('size'=>60,'maxlength'=>255)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'meta_keyword',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'meta_keyword',array('size'=>60,'maxlength'=>255)); ?>
    </div>
  </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->