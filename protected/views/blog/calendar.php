<?php
    $this->page_name = Yii::t('app', 'News');

    $this->breadcrumbs = array_merge(
            $this->breadcrumbs, $modelCategory->getBreadcrumbs(true)
    );
?>

        
<div class="col-sm-12">
    <h1 class="categoryHeader"><?php echo Yii::t('app', 'archive_news')." (".$pub_date.")"; ?></h1>
</div>


<div class="col-sm-12">
    <div class="dynamic_pages">

        <?php
        $this->widget('bootstrap.widgets.TbListView', array(
            'dataProvider' => $modelBlog->searchForCategory(null, null),
            //    'viewData' => $this->item_class,
            'itemView' => '_listview',
            'summaryText' => false,
            'pagerCssClass' => "pagination",
            'pager' => array('header' => '',
                'maxButtonCount' => 10,
                'cssFile' => false,
                'htmlOptions' => array('class' => 'pagination pull-right'),
                'prevPageLabel' => '<i class="fa fa-chevron-left"></i>',
                'nextPageLabel' => '<i class="fa fa-chevron-right"></i>',
                'firstPageLabel' => Yii::t('app', '$LNG_FIRST'),
                'lastPageLabel' => Yii::t('app', '$LNG_LAST'),
            ),
            'htmlOptions' => array('class' => 'grid_block'),
        ));
        ?>
    </div>
</div>
    