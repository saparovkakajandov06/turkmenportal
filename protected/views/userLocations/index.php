<?php
/* @var $this UserLocationsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Locations',
);

$this->menu=array(
	array('label'=>'Create UserLocations', 'url'=>array('create')),
	array('label'=>'Manage UserLocations', 'url'=>array('admin')),
);
?>

<h1>User Locations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
