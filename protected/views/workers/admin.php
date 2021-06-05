<?php
/* @var $this WorkersController */
/* @var $model Workers */

$this->breadcrumbs=array(
	'Workers'=>array('index'),
	'Manage',
);

$this->menu=array(
//	array('label'=>'List Workers', 'url'=>array('index')),
	array('label'=>'Create Workers', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#workers-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Workers</h1>


<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'workers-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'firstname',
		'lastname',
		'nickname',
		'position',
		'status',
		/*
		'date_created',
		*/
        array(
            'class' => 'bootstrap.widgets.BootButtonColumn',
            'htmlOptions' => array('style' => 'min-width: 100px; text-align:right;', 'class' => 'button_grid button-column'),
            'template' => '{update}{delete}',
        ),
	),
)); ?>
