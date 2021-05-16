<?php
/* @var $this InfoCitiesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Info Cities',
);

$this->menu=array(
//	array('label'=>'Create InfoCities', 'url'=>array('create')),
	array('label'=>'Manage InfoCities', 'url'=>array('admin')),
);
?>

<h1>Info Cities</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
