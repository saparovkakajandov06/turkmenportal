<?php
$this->breadcrumbs = array(
    Yii::t('app', 'Banner Types') => array('index'),
    Yii::t('app', 'Manage'),
);
if (!isset($this->menu) || $this->menu === array())
    $this->menu = array(
        array('label' => Yii::t('app', 'Create'), 'url' => array('create')),
        array('label' => Yii::t('app', 'List'), 'url' => array('index')),
    );
?>

    <h1> <?php echo Yii::t('app', 'Manage'); ?><?php echo Yii::t('app', 'Banner Types'); ?> </h1>

<?php
$this->widget('bootstrap.widgets.BootGridView', array(
    'id' => 'banner-type-grid',
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
        'type_name',
        'description',
        array(
            'name' => 'bannersTitle',
            'value' => '$data->getBannersTitle()',
            'type' => 'raw',
            'filter' => false
        ),
        array(
            'name' => 'size',
            'value' => '$data->getSize()',
            'filter' => false,
            'type' => 'raw',
        ),
        array(
            'name' => 'type',
            'value' => '$data->getTypeText()',
            'filter' => BannerType::getTypeOptions(),
        ),
        array(
//            'class' => 'JToggleColumn',
            'name' => 'is_mobile_enabled',
            'value' => '$data->getBannerTypeText()',
            'filter' => BannerType::getBannerTypeOptions(),
//            'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
//            'model' => get_class($model),
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
            'class' => 'bootstrap.widgets.BootButtonColumn',
            'htmlOptions' => array('style' => 'width: 85px; text-align:right;'),
        ),
    ),
));
?>