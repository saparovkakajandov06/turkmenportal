<?php
$this->breadcrumbs = array(
    Yii::t('app', 'Autos') => array('index'),
    Yii::t('app', 'Manage'),
);
if(!isset($this->menu) || $this->menu === array())
$this->menu=array(
    array('label'=>Yii::t('app', 'Create') , 'url'=>array('create')),
    array('label'=>Yii::t('app', 'List') , 'url'=>array('index')),
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('auto-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1> <?php echo Yii::t('app', 'Manage'); ?> <?php echo Yii::t('app', 'Autos'); ?> </h1>

<?php echo CHtml::link(Yii::t('app', 'Advanced Search'),'#',array('class'=>'search-button')); ?><div class="search-form" style="display: none">
    <?php $this->renderPartial('_search',array('model'=>$model,)); ?>
</div><!-- search-form -->
<?php 
$this->widget('bootstrap.widgets.BootGridView', array(
    'id' => 'auto-grid',
    'type' => 'striped bordered condensed',
    'dataProvider' => $model->searchByLanguage(),
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
            'type' => 'raw',
            'visible'=>UserModule::isAdmin(),
            'htmlOptions' => array('style' => 'width:10px;')
        ),
        array(
            'name' => 'title',
            'value' => '$data->getTitle()',
            'htmlOptions' => array('style' => 'min-width:350px;')
        ),
        array(
            'name' => 'description',
            'value' => '$data->description',
            'htmlOptions' => array('style' => 'min-width:350px;')
        ),
        array(
            'name' => 'region_id',
            'value' => '$data->getRegionName()',
            'htmlOptions' => array('style' => 'width:130px;')
        ),
        array(
            'name' => 'category_id',
            'value' => '$data->getCategoryName()',
            'htmlOptions' => array('style' => 'width:130px;')
        ),
        array(
            'name' => 'model_id',
            'value' => '$data->getModel()',
            'htmlOptions' => array('style' => 'width:130px;')
        ), array(
            'name' => 'year',
            'value' => '$data->year',
            'htmlOptions' => array('style' => 'width:130px;')
        ),array(
            'name' => 'price',
            'value' => '$data->price',
            'htmlOptions' => array('style' => 'width:130px;')
        ),array(
            'name' => 'views',
            'value' => '$data->views',
        ),array(
            'name' => 'date_added',
            'value' => '$data->date_added',
            'htmlOptions' => array('style' => 'width:130px;')
        ),array(
            'name' => 'create_username',
            'value' => '$data->create_username',
            'htmlOptions' => array('style' => 'width:130px;')
        ),

        array(
            'class' => 'JToggleColumn',
            'name' => 'status',
            'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
            'model' => get_class($model),
            'htmlOptions' => array('style' => 'text-align:center;min-width:60px; width:70px')
        ),
        array(
            'class' => 'bootstrap.widgets.BootButtonColumn',
            'htmlOptions' => array('style' => 'width: 85px; text-align:right;','class'=>'button_grid button-column'),
            'template' => '{view}{update}{delete}',
            'buttons' => array(
                'update' => array(
                    'label' => Yii::t('app', 'Crop Main Image'),
                    'url'=>'$data->getUrlupdate()',
                    'options' => array(
                        //                        'class' => 'crop'
                    ),
                ),
            ),
        ),
    ),
));
?>