<?php
/* @var $this LocationsInfoController */
/* @var $model LocationsInfo */

$this->breadcrumbs=array(
	'Locations Infos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List LocationsInfo', 'url'=>array('index')),
	array('label'=>'Create LocationsInfo', 'url'=>array('create')),
	array('label'=>'View LocationsInfo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage LocationsInfo', 'url'=>array('admin')),
);
?>

<h1>Update LocationsInfo <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>