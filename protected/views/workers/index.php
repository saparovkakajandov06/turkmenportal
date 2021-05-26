<?php
/* @var $this WorkersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Workers',
);

$this->menu=array(
	array('label'=>'Create Workers', 'url'=>array('create')),
	array('label'=>'Manage Workers', 'url'=>array('admin')),
);
?>

<h1>Workers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
