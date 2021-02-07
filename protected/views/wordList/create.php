<?php
/* @var $this WordFilterController */
/* @var $model WordList */

$this->breadcrumbs=array(
	'Word Filters'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List WordFilter', 'url'=>array('index')),
	array('label'=>'Manage WordFilter', 'url'=>array('admin')),
);
?>

<h1>Create WordFilter</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>