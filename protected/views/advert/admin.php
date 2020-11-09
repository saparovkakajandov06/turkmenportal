<?php
$this->breadcrumbs = array(
    Yii::t('app', 'Catalogs') => array('index'),
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
$.fn.yiiGridView.update('catalog-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1> <?php echo Yii::t('app', 'Manage'); ?> <?php echo Yii::t('app', 'Catalogs'); ?> </h1>

<?php echo CHtml::link(Yii::t('app', 'Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display: none">
    <?php $this->renderPartial('_search',array(
    'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php 
//$ttt=$model->searchByLanguage()->getData();
//echo "<pre>";
//print_r($ttt);
//echo "</pre>";

 $this->widget('bootstrap.widgets.BootGridView', array(
    'id' => 'catalog-grid',
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
        'id',
//        'region_id',
        array(
            'name' => 'category_id',
            'value' => '$data->category_name',
            'filter'=>Category::model()->getCategoryTreeList(),
//            'type' => 'raw',
        ),
//        array(
//            'name' => 'category_name',
//            'value' => '$data->category->code',
//            'type' => 'raw',
//        ),
//        array(
//            'name' => 'name',
//            'value' => '$data->name',
//        ),
        array(
            'name' => 'title',
            'value' => '$data->getTitle()',
        ),
        array(
            'name' => 'description',
            'value' => 'Yii::app()->controller->truncate($data->getDescription(), 15, 450)',
        ),
        'address',
        'phone',
//        'mail',
//        'web',
//        'rating',
//        'period',
        'views',
//        'likes',
        array(
            'class' => 'JToggleColumn',
            'name' => 'status',
            'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
            'model' => get_class($model),
            'htmlOptions' => array('style' => 'text-align:center;min-width:60px;')
        ),
        'date_added',
        array(
            'name' => 'create_username',
            'value' => '$data->create_username',
            'htmlOptions' => array('style' => 'width:130px;')
        ),
        array(
        'class' => 'bootstrap.widgets.BootButtonColumn',
        'htmlOptions' => array('style' => 'width: 100px; text-align:right;','class'=>'button_grid button-column'),
        'template' => '{view}{update}{crop}{delete}',
        'buttons' => array(
            'crop' => array(
                'label' => Yii::t('app', 'Crop Main Image'),
                'icon'=>'crop',
                'url' => 'Yii::app()->createUrl("//documents/crop",array("id"=>$data->getDocument()->id))',
                'options' => array(
                    'class' => 'crop'
                ),
            ),
//            'fileupload' => array(
//                'label' => Yii::t('app', 'Additional files'),
//                'icon'=>'upload',
//                'url' => 'Yii::app()->createUrl("//catalog/fileupload",array("id"=>$data->id))',
//                'options' => array(
//                    'class' => 'fileupload'
//                ),
//            ),
        ),
    ),
        
        
//        array(
//            'class' => 'bootstrap.widgets.BootButtonColumn',
//            'htmlOptions' => array('style' => 'width: 85px; text-align:right;'),
//        ),
    ),
));
?>