<?php
/* @var $this WordFilterController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Word Filters',
);

$this->menu=array(
//	array('label'=>'Create WordFilter', 'url'=>array('create')),
//	array('label'=>'Manage WordFilter', 'url'=>array('admin')),
);
?>

<h1>Word Filters</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
