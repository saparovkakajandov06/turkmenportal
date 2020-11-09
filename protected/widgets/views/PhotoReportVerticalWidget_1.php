
<?php
    $categoryModel = Category::model()->findByAttributes(array('code' => 'fotoreport'));
    $sub_categories = Category::model()->sort_by_sort_order()->with_parent()->findAllByAttributes(array('parent_id' => $categoryModel->id));
?>


<div class="subnav-tabbed-panels vertical-panel" >
     <span class="photoreport_header"> <?php echo $categoryModel->getMixedDescriptionModel()->name;?> </span>
    <div id="tabAll" class="subnav-tabbed-panel">
        <?php
            $this->widget('bootstrap.widgets.BootListView', array(
                'dataProvider' => $dataProvider,
                'itemView' => '_listview_fotoreport_vertical',
                'summaryText' => '',
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
            ));
        ?>
    </div>
</div>


