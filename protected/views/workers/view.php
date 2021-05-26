<?php
/* @var $this WorkersController */
/* @var $model Workers */

$this->breadcrumbs=array(
	'Workers'=>array('index'),
	$model->id,
);

$this->menu=array(
//	array('label'=>'List Workers', 'url'=>array('index')),
	array('label'=>'Create Workers', 'url'=>array('create')),
	array('label'=>'Update Workers', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Workers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Workers', 'url'=>array('admin')),
);
?>

<h1>View Workers #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'firstname',
		'lastname',
		'nickname',
		'position',
		'status',
		'date_created',
	),
)); ?>
