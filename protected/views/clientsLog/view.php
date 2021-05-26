<?php
/* @var $this ClientsLogController */
/* @var $model ClientsLog */

$this->breadcrumbs=array(
	'Clients Logs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ClientsLog', 'url'=>array('index')),
	array('label'=>'Create ClientsLog', 'url'=>array('create')),
	array('label'=>'Update ClientsLog', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ClientsLog', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ClientsLog', 'url'=>array('admin')),
);
?>

<h1>View ClientsLog #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'clien_id',
		'model',
		'model_id',
		'date_created',
	),
)); ?>
