<!--noindex-->
<?php $this->beginWidget('DNofollowWidget'); ?>
<?php Yii::app()->controller->categoryUrl = $categoryModel->url; ?>

<?php
$title = $categoryModel->name;
if (isset($this->override_main_title) && strlen(trim($this->override_main_title)) > 2)
    $title = $this->override_main_title;
?>
<?php echo CHtml::link(Yii::t('app', 'more'), $categoryModel->url, array('class' => 'more-link')); ?>
<?php $this->endWidget(); ?>
<!--/noindex-->