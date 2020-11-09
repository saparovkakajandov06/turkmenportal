<?php
$this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
//    'viewData' => $this->item_class,
    'itemView' => '_listview_blog_oilgas',
    'summaryText' => false,
    'pagerCssClass' => "pagination",
    'pager' => array('header' => '',
             'maxButtonCount' => $this->maxPagerCount,
             'cssFile' => false,
             'htmlOptions'=>array('class'=>'pagination pull-right'),
             'prevPageLabel' => '<i class="fa fa-chevron-left"></i>',
             'nextPageLabel' => '<i class="fa fa-chevron-right"></i>',
             'firstPageLabel' => Yii::t('app','$LNG_FIRST'),
             'lastPageLabel' => Yii::t('app','$LNG_LAST'),
    ),
    'htmlOptions' => array('class' => 'grid_block'),
));
?>

<div class="clearfix"></div>
<?php if(isset ($this->show_all) && $this->show_all==true && $this->categoryModel!=null) {?>
    <div class="show_all_wrapper">
        <a class="show_all_big" href="<?php echo Yii::app()->createUrl('//blog/category',array('category_id'=>$this->categoryModel->id))?>" >
            <?php echo Yii::t('app', 'SHOW ALL')?>
            <i class="fa fa-chevron-down" ></i>
        </a>
    </div>
<?php }?>