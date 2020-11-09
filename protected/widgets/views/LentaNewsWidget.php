 <!--noindex-->
<?php $this->beginWidget('DNofollowWidget'); ?>
 
<div class="row box_header_index">
    <div class="col-md-12"><span class="headerColor mini"><?php echo Yii::t('app','latest_news');?></span></div>
</div>

<?php
$this->widget('bootstrap.widgets.BootListView', array(
    'dataProvider' => $dataProvider,
//    'viewData' => $this->item_class,
    'itemView' => '_lenta_news',
    'summaryText' => false,
    'pagerCssClass' => "pagination",
    'htmlOptions' => array('class' => 'row'),
    'pager' => array('header' => '',
        'maxButtonCount' => $this->count,
        'cssFile' => false,
        'htmlOptions' => array('class' => 'pagination pull-right'),
        'prevPageLabel' => '<i class="fa fa-chevron-left"></i>',
        'nextPageLabel' => '<i class="fa fa-chevron-right"></i>',
        'firstPageLabel' => Yii::t('app', '$LNG_FIRST'),
        'lastPageLabel' => Yii::t('app', '$LNG_LAST'),
    ),
));
?>

<div class="clearfix"></div>

<?php if(isset ($this->show_all) && $this->show_all==true) {?>
    <div class="show_all_wrapper">
        <a class="show_all_big" href="#" >SHOW ALL</a>
    </div>
<?php }?>
<?php $this->endWidget(); ?>
<!--/noindex-->