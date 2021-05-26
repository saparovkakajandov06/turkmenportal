<?php
/* @var $this ClientsLogController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Clients Logs',
);

$this->menu=array(
	array('label'=>'Create ClientsLog', 'url'=>array('create')),
	array('label'=>'Manage ClientsLog', 'url'=>array('admin')),
);
?>

<h1>Clients Logs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
