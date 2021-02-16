<?php
/* @var $this WordFilterController */
/* @var $model WordList */

$this->breadcrumbs=array(
	'Word Filters'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List WordFilter', 'url'=>array('index')),
	array('label'=>'Create WordFilter', 'url'=>array('create')),
	array('label'=>'Update WordFilter', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete WordFilter', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage WordFilter', 'url'=>array('admin')),
);
?>

<h1>View WordFilter #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'word',
		'definition',
		'content',
		'type',
	),
)); ?>
