<?php
/* @var $this WorkersLogController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Workers Logs',
);

$this->menu=array(
	array('label'=>'Create WorkersLog', 'url'=>array('create')),
	array('label'=>'Manage WorkersLog', 'url'=>array('admin')),
);
?>

<h1>Workers Logs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
