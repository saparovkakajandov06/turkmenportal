<?php
/* @var $this WorkersLogController */
/* @var $model WorkersLog */

$this->breadcrumbs=array(
	'Workers Logs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List WorkersLog', 'url'=>array('index')),
	array('label'=>'Create WorkersLog', 'url'=>array('create')),
	array('label'=>'Update WorkersLog', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete WorkersLog', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage WorkersLog', 'url'=>array('admin')),
);
?>

<h1>View WorkersLog #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'worker_id',
		'model',
		'model_id',
		'date_created',
	),
)); ?>
