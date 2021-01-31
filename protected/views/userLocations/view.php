<?php
/* @var $this UserLocationsController */
/* @var $model UserLocations */

$this->breadcrumbs=array(
	'User Locations'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserLocations', 'url'=>array('index')),
	array('label'=>'Create UserLocations', 'url'=>array('create')),
	array('label'=>'Update UserLocations', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserLocations', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserLocations', 'url'=>array('admin')),
);
?>

<h1>View UserLocations #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'ip',
		'country',
		'latitude',
		'longitude',
		'date_created',
		'date_updated',
	),
)); ?>
