<?php
/* @var $this WorkersLogController */
/* @var $model WorkersLog */

$this->breadcrumbs=array(
	'Workers Logs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List WorkersLog', 'url'=>array('index')),
	array('label'=>'Manage WorkersLog', 'url'=>array('admin')),
);
?>

<h1>Create WorkersLog</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>