<?php
/* @var $this UserLocationsController */
/* @var $model UserLocations */

$this->breadcrumbs=array(
	'User Locations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserLocations', 'url'=>array('index')),
	array('label'=>'Create UserLocations', 'url'=>array('create')),
	array('label'=>'View UserLocations', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserLocations', 'url'=>array('admin')),
);
?>

<h1>Update UserLocations <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>