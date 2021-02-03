<?php
/* @var $this InfoCitiesController */
/* @var $model InfoCities */

$this->breadcrumbs=array(
	'Info Cities'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List InfoCities', 'url'=>array('index')),
//	array('label'=>'Create InfoCities', 'url'=>array('create')),
);
?>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
));

?>
</div><!-- search-form -->


<?php $this->widget('bootstrap.widgets.BootGridView', array(
    'id' => 'blog-grid',
    'type' => 'striped bordered condensed',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'summaryText' => Yii::t('app', 'Displaying {start}-{end} of {count} result(s).'),
    'pagerCssClass' => "pagination",
    'pager' => array('header' => '',
        'maxButtonCount' => $this->maxButtonCount,
        'cssFile' => false,
        'htmlOptions' => array('class' => 'pagination pull-right'),
        'prevPageLabel' => '<i class="fa fa-chevron-left"></i>',
        'nextPageLabel' => '<i class="fa fa-chevron-right"></i>',
        'firstPageLabel' => Yii::t('app', '$LNG_FIRST'),
        'lastPageLabel' => Yii::t('app', '$LNG_LAST'),
    ),
    'columns' => array(
        array(
            'name' => 'id',
            'value' => '$data->id',
            'htmlOptions' => array('style' => 'text-align:center;width:30px;')
        ),
        array(
            'name' => 'citi_name',
            'value' => '$data->citi_name',
            'htmlOptions' => array('style' => 'text-align:center;width:20px;')
        ),
        array(
            'name' => 'lon',
            'value' => '$data->lon',
            'htmlOptions' => array('style' => 'text-align:center;width:20px;')
        ),
        array(
            'name' => 'lat',
            'value' => '$data->lat',
            'htmlOptions' => array('style' => 'text-align:center;width:20px;')
        ),
        array(
            'name' => 'name_ru',
            'value' => '$data->name_ru',
            'htmlOptions' => array('style' => 'text-align:center;width:20px;')
        ),
        array(
            'name' => 'sort_order',
            'value' => '$data->sort_order',
            'htmlOptions' => array('style' => 'text-align:center;width:20px;')
        ),
        array(
            'class' => 'JToggleColumn',
            'name' => 'top',
            'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
            'model' => get_class($model),
            'htmlOptions' => array('style' => 'text-align:center;width:20px;')
        ),
        array(
            'class' => 'JToggleColumn',
            'name' => 'status',
            'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
            'model' => get_class($model),
            'htmlOptions' => array('style' => 'text-align:center;width:20px;')
        ),
        array(
            'class' => 'JToggleColumn',
            'name' => 'visibility',
            'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
            'model' => get_class($model),
            'htmlOptions' => array('style' => 'text-align:center;width:20px;')
        ),
        array(
            'class' => 'bootstrap.widgets.BootButtonColumn',
            'htmlOptions' => array('style' => ' width:20px;text-align:right;', 'class' => 'button_grid button-column'),
            'template' => '{view}{update}{delete}',
        ),

    ),
)); ?>