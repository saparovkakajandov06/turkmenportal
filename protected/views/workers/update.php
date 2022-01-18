<?php
/* @var $this WorkersController */
/* @var $model Workers */

$this->breadcrumbs=array(
	'Workers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
//	array('label'=>'List Workers', 'url'=>array('index')),
	array('label'=>'Create Workers', 'url'=>array('create')),
//	array('label'=>'View Workers', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Workers', 'url'=>array('admin')),
);
?>

<h1>Update Workers <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>