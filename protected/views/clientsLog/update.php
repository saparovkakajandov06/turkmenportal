<?php
/* @var $this ClientsLogController */
/* @var $model ClientsLog */

$this->breadcrumbs=array(
	'Clients Logs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ClientsLog', 'url'=>array('index')),
	array('label'=>'Create ClientsLog', 'url'=>array('create')),
	array('label'=>'View ClientsLog', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ClientsLog', 'url'=>array('admin')),
);
?>

<h1>Update ClientsLog <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>