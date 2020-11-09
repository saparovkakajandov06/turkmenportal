<div class="wide form">

<?php $form = $this->beginWidget('CActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

  <div class="control-group">
    <?php echo $form->labelEx($model,'search',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'search'); ?>
      <?php echo $form->dropDownList($model, 'category_id', CHtml::listData(Category::model()->findAll(),'id','id')); ?>
    </div>
  </div>

  <div class="control-group">    
    <div class="controls">
        <?php echo $form->labelEx($model,'is_subcat',array('class'=>'control-label')) ; ?>
        <?php echo $form->checkBox($model,'is_subcat'); ?>
        <?php echo $form->labelEx($model,'is_description',array('class'=>'control-label')) ; ?>
        <?php echo $form->checkBox($model,'is_description'); ?>
    </div>
  </div>
 
    <div class="row buttons">
            <?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->