<div class="search-form-mini form">

<?php $form = $this->beginWidget('CActiveForm', array(
	'action' => Yii::app()->createUrl('//catalog/category',array('category_id'=>$category_id)),
	'method' => 'get',
)); ?>

    <?php //echo $form->hiddenField($model,'category_id'); ?>
  
  <!--<div class="control-group">-->
    <div class="controls">
        <?php echo CHtml::textField('mini_search','',array('placeholder'=>Yii::t('app', 'mini_search_placeholder'))); ?>
        <?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
    </div>
  <!--</div>-->


<?php $this->endWidget(); ?>
</div><!-- search-form -->