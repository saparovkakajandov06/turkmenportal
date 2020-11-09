<?php
$this->breadcrumbs = array(
    Yii::t('app', 'Blogs') => array('index'),
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
$.fn.yiiGridView.update('blog-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1> <?php echo Yii::t('app', 'Manage'); ?> <?php echo Yii::t('app', 'Blogs'); ?> </h1>

<?php echo CHtml::link(Yii::t('app', 'Advanced Search'),'#',array('class'=>'search-button')); ?><div class="search-form" style="display: none">
    <?php $this->renderPartial('_search',array(
    'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php $this->widget('bootstrap.widgets.BootGridView', array(
'id' => 'blog-grid',
'type'=>'striped bordered condensed',
'dataProvider' => $model->searchByLanguage(),
'filter' => $model,
'summaryText'=>Yii::t('app','Displaying {start}-{end} of {count} result(s).'),
'pagerCssClass'=>"pagination",
'pager' => array('header' => '',
             'maxButtonCount' => $this->maxButtonCount,
             'cssFile' => false,
             'htmlOptions'=>array('class'=>'pagination pull-right'),
             'prevPageLabel' => '<i class="fa fa-chevron-left"></i>',
             'nextPageLabel' => '<i class="fa fa-chevron-right"></i>',
             'firstPageLabel' => Yii::t('app','$LNG_FIRST'),
             'lastPageLabel' => Yii::t('app','$LNG_LAST'),
),
'columns' => array(
        array(
                    'name' => 'id',
                    'value' => '$data->id',
                    'type' => 'raw',
                    'visible'=>UserModule::isAdmin(),
            ),
        'web',
//        array(
//                    'name' => 'image',
//                    'value' => '$data->image',
//                    'filter' => false,
//            ),
        array(
                    'name' => 'title',
                    'value' => '$data->getTitle()',
                    'type' => 'raw',
            ),
        array(
                'name' => 'description',
                'value' => 'Yii::app()->controller->truncate($data->getDescription(),10,150)',
                'type' => 'raw',
            ),
            'visited_count',
        array(
                    'class' => 'JToggleColumn',
                    'name' => 'status',
                    'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
                                        'model' => get_class($model),
                                        'htmlOptions' => array('style' => 'text-align:center;min-width:60px;')
                    ),
        array(
                    'class' => 'JToggleColumn',
                    'name' => 'is_main',
                    'visible'=>UserModule::isAdmin(),
                    'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
                                        'model' => get_class($model),
                                        'htmlOptions' => array('style' => 'text-align:center;min-width:60px;')
                    ),
        array(
                    'class' => 'JToggleColumn',
                    'name' => 'is_photoreport',
                    'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
                                        'model' => get_class($model),
                                        'htmlOptions' => array('style' => 'text-align:center;min-width:60px;')
                    ),
        array(
                    'class' => 'JToggleColumn',
                    'name' => 'is_clients',
                    'visible'=>UserModule::isAdmin(),
                    'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
                                        'model' => get_class($model),
                                        'htmlOptions' => array('style' => 'text-align:center;min-width:60px;')
                    ),
        'edited_username',
        'date_modified',
array(
        'class' => 'bootstrap.widgets.BootButtonColumn',
        'htmlOptions' => array('style' => 'width: 85px; text-align:right;','class'=>'button_grid button-column'),
        'template' => '{view}{update}{crop}{delete}',
        'buttons' => array(
            'crop' => array(
                'label' => Yii::t('app', 'Crop Main Image'),
                'icon'=>'crop',
                'url' => 'Yii::app()->createUrl("//documents/crop",array("id"=>$data->getDocument()->id))',
//                'imageUrl' => Yii::app()->request->baseUrl . '/images/postupdate2.png',
                'options' => array(
//                    'ajax' => array(
//                        'type' => 'GET',
//                        'url' => "js:$(this).attr('href')",
//                        'update' => '#harytlar_post_update_dialog',
//                    ),
                    'class' => 'crop'
                ),
            ),
        ),
    ),
),
)); ?>