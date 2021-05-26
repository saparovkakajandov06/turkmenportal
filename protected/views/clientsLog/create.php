<?php
/* @var $this ClientsLogController */
/* @var $model ClientsLog */

$this->breadcrumbs=array(
	'Clients Logs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ClientsLog', 'url'=>array('index')),
	array('label'=>'Manage ClientsLog', 'url'=>array('admin')),
);
?>

<h1>Create ClientsLog</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>