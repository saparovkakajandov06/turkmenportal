<?php
/* @var $this UserLocationsController */
/* @var $model UserLocations */

$this->breadcrumbs=array(
	'User Locations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserLocations', 'url'=>array('index')),
	array('label'=>'Manage UserLocations', 'url'=>array('admin')),
);
?>

<h1>Create UserLocations</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>