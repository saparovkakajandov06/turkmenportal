<?php
/* @var $this LocationsInfoController */
/* @var $model LocationsInfo */

$this->breadcrumbs=array(
	'Locations Infos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List LocationsInfo', 'url'=>array('index')),
	array('label'=>'Manage LocationsInfo', 'url'=>array('admin')),
);
?>

<h1>Create LocationsInfo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>