<?php
$this->breadcrumbs = array(
    Yii::t('app', 'Categories') => array('index'),
    Yii::t('app', 'Manage'),
);
if (!isset($this->menu) || $this->menu === array())
    $this->menu = array(
        array('label' => Yii::t('app', 'Create'), 'url' => array('create')),
        array('label' => Yii::t('app', 'List'), 'url' => array('index')),
    );

  

?>

<h1> <?php echo Yii::t('app', 'Manage'); ?> <?php echo Yii::t('app', 'Categories'); ?> </h1>


<?php

$this->widget('bootstrap.widgets.BootGridView', array(
    'id' => 'category-grid',
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
            'htmlOptions' => array('style' => 'width:25px;')
        ),
        array(
            'name' => 'name',
            'value' => '$data->name',
            'htmlOptions' => array('style' => 'width:25%; font-weight:normal;')
        ),
        array(
            'name' => 'parent_id',
            'value' => '$data->getParentInheritance(false)',
            'type' => 'raw',
            'filter'=>  Category::model()->getParentCategoriesList(),
            'htmlOptions' => array('style' => 'min-width:160px; font-style:italic; color:#999;')
        ),
//        
//        array(
//            'name' => 'related_category_id',
//            'value' => '$data->getRelatedCategoryName()',
////            'filter'=>  Category::model()->getParentCategoriesList(),
//            'htmlOptions' => array('style' => 'min-width:160px; font-style:italic; color:#999;')
//        ),
        array(
            'name' => 'code',
            'value' => '$data->code',
            'htmlOptions' => array('style' => 'width:100px; font-style:italic; color:#999;')
        ),
//        array(
//            'name' => 'alias_ru',
//            'value' => '$data->alias_ru',
//            'htmlOptions' => array('style' => 'width:100px; font-style:italic; color:#999;')
//        ),

//        'code',
      
        array(
            'class' => 'JToggleColumn',
            'name' => 'top',
            'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
            'model' => get_class($model),
            'htmlOptions' => array('style' => 'text-align:center;width:15px;')
        ),
        array(
            'class' => 'JToggleColumn',
            'name' => 'is_announcement',
            'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
            'model' => get_class($model),
            'htmlOptions' => array('style' => 'text-align:center;width:15px;')
        ),
         array(
            'name' => 'sort_order',
            'value' => '$data->sort_order',
            'htmlOptions' => array('style' => 'width:100px;')
        ),
        array(
            'class' => 'JToggleColumn',
            'name' => 'status',
            'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
            'model' => get_class($model),
            'htmlOptions' => array('style' => 'text-align:center;width:20px;')
        ),
//        array(
//            'name' => 'is_used',
//            'value' => '$data->isCategoryUsed()',
//            'type'=>'raw',
//            'filter'=>false,
//            'htmlOptions' => array('style' => 'width:20px; font-style:italic; color:#999;')
//        ),
         array(
            'name' => 'date_modified',
            'value' => '$data->date_modified',
            'htmlOptions' => array('style' => 'width:160px; font-style:italic; color:#999;')
        ),
        array(
            'class' => 'bootstrap.widgets.BootButtonColumn',
            'htmlOptions' => array('style' => 'width: 85px; text-align:right;'),
        ),
    ),
));
?>