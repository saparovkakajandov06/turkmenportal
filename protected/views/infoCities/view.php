<?php
/* @var $this InfoCitiesController */
/* @var $model InfoCities */

$this->breadcrumbs=array(
	'Info Cities'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List InfoCities', 'url'=>array('index')),
	array('label'=>'Create InfoCities', 'url'=>array('create')),
	array('label'=>'Update InfoCities', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete InfoCities', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage InfoCities', 'url'=>array('admin')),
);
?>

<h1>View InfoCities #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'citi_id',
		'citi_name',
		'state',
		'country',
		'lon',
		'lat',
		'visibility',
		'status',
	),
)); ?>
