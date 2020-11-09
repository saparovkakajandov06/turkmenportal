
<?php
$this->breadcrumbs = array_merge(
    $this->breadcrumbs, array(
        Yii::t('app','Search')=>Yii::app()->createUrl('search/search'),
//        Yii::t('app','search_query',array('query'=>CHtml::encode($query)))
        CHtml::encode($query)
    )
);

$this->is_inner_breadcrumb = false;
$this->pageTitle=Yii::t('app','search_query',array('query'=>CHtml::encode($query)))." | ".Yii::t('app','Search')
?>

<?php               
    $this->renderPartial('//search/_form', array('query' => $query, 'category_id'=>$category_id,'region_id'=>$region_id,));
?>
<h4 class="search_query_title"> <?php echo Yii::t('app','search_query_advanced',array('query'=>CHtml::encode($query))); ?></h4>
<hr>

<div class="row">
    <div class="col-md-12">
        <?php
        $this->widget('application.widgets.banners.BannersWidget', array(
            'type' => 'bannerSearchMain',
            'outer_css_id' => 'bannerSearchMain',
        ));
        ?>
    </div>
</div>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'ajaxUrl'=>Yii::app()->createUrl('//search/index',array('query'=>$query)),
    'itemView'=>'_item',
    'viewData'=> array('query'=>$query),
    'summaryText' => false,
    'pagerCssClass' => "pagination",
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
