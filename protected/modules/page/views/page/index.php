<?php
$this->breadcrumbs = array(
    Yii::t('app', 'oilgas_complex')
);

$this->department=false;
$this->press=false;

?>
<div class="col-sm-12">
        <h1 class="categoryHeader"><?php echo Yii::t('app', 'oilgas_complex'); ?></h1>
</div>

<?php $this->widget('bootstrap.widgets.BootListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
    'summaryText' => false,
    'pagerCssClass' => "pagination",
    'htmlOptions' => array('class' => ''),
    'pager' => array('header' => '',
        'maxButtonCount' => 5,
        'cssFile' => false,
        'htmlOptions' => array('class' => 'pagination pull-right'),
        'prevPageLabel' => '<i class="fa fa-chevron-left"></i>',
        'nextPageLabel' => '<i class="fa fa-chevron-right"></i>',
        'firstPageLabel' => Yii::t('app', '$LNG_FIRST'),
        'lastPageLabel' => Yii::t('app', '$LNG_LAST'),
    ),
)); ?>
