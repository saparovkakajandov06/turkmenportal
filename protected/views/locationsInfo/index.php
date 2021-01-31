<?php
/* @var $this LocationsInfoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Locations Infos',
);

$this->menu=array(
	array('label'=>'Create LocationsInfo', 'url'=>array('create')),
	array('label'=>'Manage LocationsInfo', 'url'=>array('admin')),
);
?>

<h1>Locations Infos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
