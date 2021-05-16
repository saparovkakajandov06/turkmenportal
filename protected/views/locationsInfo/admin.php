<?php
/* @var $this LocationsInfoController */
/* @var $model LocationsInfo */

$this->breadcrumbs=array(
	'Locations Infos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List LocationsInfo', 'url'=>array('index')),
	array('label'=>'Create LocationsInfo', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#locations-info-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Locations Infos</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'locations-info-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'location_id',
		'continent',
		'country_code',
		'country_flag',
		'country_capital',
		/*
		'country_phone',
		'country_neighbours',
		'region',
		'city',
		'asn',
		'org',
		'isp',
		'timezone',
		'timezone_name',
		'timezone_gmt',
		'currency',
		'currency_code',
		'currency_symbol',
		'currency_rates',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
