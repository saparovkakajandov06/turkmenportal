<?php
/* @var $this WorkersController */
/* @var $model Workers */

$this->breadcrumbs=array(
	'Workers'=>array('index'),
	'Create',
);

$this->menu=array(
//	array('label'=>'List Workers', 'url'=>array('index')),
	array('label'=>'Manage Workers', 'url'=>array('admin')),
);
?>

<h1>Create Workers</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>