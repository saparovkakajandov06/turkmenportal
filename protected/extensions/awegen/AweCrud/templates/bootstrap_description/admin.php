<?php
echo "<?php\n";
$label = $this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs = array(
    Yii::t('app', '$label') => array('index'),
    Yii::t('app', 'Manage'),
);"
?>

if(!isset($this->menu) || $this->menu === array())
$this->menu=array(
    array('label'=>Yii::t('app', 'Create') , 'url'=>array('create')),
    array('label'=>Yii::t('app', 'List') , 'url'=>array('index')),
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('<?php echo $this->class2id($this->modelClass); ?>-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1> <?php
echo "<?php echo Yii::t('app', 'Manage'); ?> ";
echo "<?php echo Yii::t('app', '" . $this->pluralize($this->class2name($this->modelClass)) . "'); ?> ";
?></h1>

<?php echo "<?php echo CHtml::link(Yii::t('app', 'Advanced Search'),'#',array('class'=>'search-button')); ?>"; ?>
<div class="search-form" style="display: none">
    <?php echo "<?php \$this->renderPartial('_search',array(
    'model'=>\$model,
)); ?>\n"; ?>
</div><!-- search-form -->
<?php echo '<?php'; ?> $this->widget('bootstrap.widgets.BootGridView', array(
'id' => '<?php echo $this->class2id($this->modelClass); ?>-grid',
'type'=>'striped bordered condensed',
'dataProvider' => $model->search(),
'filter' => $model,
'summaryText'=>Yii::t('app','Displaying {start}-{end} of {count} result(s).'),
'pagerCssClass'=>"pagination",
'pager' => array('header' => '',
             'maxButtonCount' => $this->maxButtonCount,
             'cssFile' => false,
             'htmlOptions'=>array('class'=>'pagination pull-right'),
             'prevPageLabel' => '<i class="fa fa-chevron-left"></i>',
             'nextPageLabel' => '<i class="fa fa-chevron-right"></i>',
             'firstPageLabel' => Yii::t('app','$LNG_FIRST'),
             'lastPageLabel' => Yii::t('app','$LNG_LAST'),
),
'columns' => array(
<?php
foreach ($this->tableSchema->columns as $column) {
  echo "        " . $this->generateGridViewColumn($column) . ",\n";
}
?>
array(
'class'=>'bootstrap.widgets.BootButtonColumn',
'htmlOptions'=>array('style'=>'width: 85px; text-align:right;'),
),
),
)); ?>