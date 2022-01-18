<?php
/* @var $this WorkersLogController */
/* @var $model WorkersLog */

$this->breadcrumbs=array(
	'Workers Logs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List WorkersLog', 'url'=>array('index')),
	array('label'=>'Create WorkersLog', 'url'=>array('create')),
	array('label'=>'View WorkersLog', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage WorkersLog', 'url'=>array('admin')),
);
?>

<h1>Update WorkersLog <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>