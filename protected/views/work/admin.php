<?php
$this->breadcrumbs = array(
    Yii::t('app', 'Employees') => array('index'),
    Yii::t('app', 'Manage'),
);
if (!isset($this->menu) || $this->menu === array())
    $this->menu = array(
        array('label' => Yii::t('app', 'Create'), 'url' => array('create')),
        array('label' => Yii::t('app', 'List'), 'url' => array('index')),
    );


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('employees-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

    <h1> <?php echo Yii::t('app', 'Manage'); ?><?php echo Yii::t('app', 'Employees'); ?> </h1>

<?php echo CHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button')); ?>
    <div class="search-form" style="display: none">
<?php //$this->renderPartial('_search', array(
//    'model' => $model,
//)); ?>
    </div><!-- search-form -->
<?php $this->widget('bootstrap.widgets.BootGridView', array(
    'id' => 'employees-grid',
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
        'id',
        'region_id',
        'phone',
        'mail',
        'profession_id',
        'branch_id',
        array(
            'class' => 'JToggleColumn',
            'name' => 'education',
            'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
            'model' => get_class($model),
            'htmlOptions' => array('style' => 'text-align:center;min-width:60px;')
        ),
        'languages',
        'rating',
        'period',
        'views',
        'likes',
        array(
            'class' => 'JToggleColumn',
            'name' => 'status',
            'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
            'model' => get_class($model),
            'htmlOptions' => array('style' => 'text-align:center;min-width:60px;')
        ),
        'edited_username',
        'create_username',
        'date_added',
        'date_modified',

        array(
            'class' => 'bootstrap.widgets.BootButtonColumn',
            'htmlOptions' => array('style' => 'width: 85px; text-align:right;', 'class' => 'button_grid button-column'),
            'template' => '{view}{update}{delete}',
            'buttons' => array(
                'update' => array(
                    'label' => Yii::t('app', 'Crop Main Image'),
                    'url' => '$data->getUrlupdate()',
                    'options' => array(//                        'class' => 'crop'
                    ),
                ),
            ),
        ),

    ),
)); ?>