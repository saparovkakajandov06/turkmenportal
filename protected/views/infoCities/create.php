<?php
/* @var $this InfoCitiesController */
/* @var $model InfoCities */

$this->breadcrumbs=array(
	'Info Cities'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List InfoCities', 'url'=>array('index')),
	array('label'=>'Manage InfoCities', 'url'=>array('admin')),
);
?>

<h1>Create InfoCities</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>