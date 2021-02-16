<?php
/* @var $this WordFilterController */
/* @var $model WordList */

$this->breadcrumbs=array(
	'Word Filters'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
//	array('label'=>'List WordFilter', 'url'=>array('index')),
//	array('label'=>'Create WordFilter', 'url'=>array('create')),
//	array('label'=>'View WordFilter', 'url'=>array('view', 'id'=>$model->id)),
//	array('label'=>'Manage WordFilter', 'url'=>array('admin')),
);
?>

<h1>Update WordFilter <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>