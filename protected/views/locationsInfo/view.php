<?php
/* @var $this LocationsInfoController */
/* @var $model LocationsInfo */

$this->breadcrumbs=array(
	'Locations Infos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List LocationsInfo', 'url'=>array('index')),
	array('label'=>'Create LocationsInfo', 'url'=>array('create')),
	array('label'=>'Update LocationsInfo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete LocationsInfo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage LocationsInfo', 'url'=>array('admin')),
);
?>

<h1>View LocationsInfo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'location_id',
		'continent',
		'country_code',
		'country_flag',
		'country_capital',
		'country_phone',
		'country_neighbours',
		'region',
		'city',
		'asn',
		'org',
		'isp',
		'timezone',
		'timezone_name',
		'timezone_gmt',
		'currency',
		'currency_code',
		'currency_symbol',
		'currency_rates',
	),
)); ?>
