<?php
$this->breadcrumbs = array_merge(
    $this->breadcrumbs, $modelCategory->getBreadcrumbs(true)
);
$this->is_inner_breadcrumb = true;
$this->enable_mobile_banner_vtop1 = true;
$this->subCategoryModel = $modelCategory;
?>


<div class="row">
    <div class="col-sm-3 col-xs-12">
        <?php $this->renderPartial('//layouts/common/column2_left'); ?>
    </div>


    <div class="col-sm-9 col-xs-12 border-left level2_cont_right">

        <h1 class="categoryHeader">
            <?php
            $title = $modelCategory->name;
            if (isset($modelBlog->pub_date) && strlen(trim($modelBlog->pub_date)) > 0) {
                $title .= "(" . $modelBlog->pub_date_formatted . ")";
            }
            echo $title;
            ?>
        </h1>
        <?php
        $this->widget('bootstrap.widgets.TbListView', array(
            'dataProvider' => $modelBlog->searchForCategory(null),
            //    'viewData' => $this->item_class,
            'itemView' => '_listview',
            'summaryText' => false,
            'pagerCssClass' => "pagination",
            'pager' => array('header' => '',
                'maxButtonCount' => 5,
                'cssFile' => false,
                'htmlOptions' => array('class' => 'pagination'),
                'prevPageLabel' => '<i class="fa fa-angle-left"></i>',
                'nextPageLabel' => '<i class="fa fa-angle-right"></i>',
                'firstPageLabel' => '<i class="fa fa-angle-double-left"></i>',
                'lastPageLabel' => '<i class="fa fa-angle-double-right"></i>',
            ),
            'htmlOptions' => array('class' => 'grid_block'),
            'template' => "{sorter}\n{items}\n{pager}{summary} ",
//            'sorterCssClass' => 'auto_sorter',
//            'sortableAttributes' => array(
//                'date_added' => Yii::t('app', 'sort_by_date'),
//                'visited_count' => Yii::t('app', 'sort_by_read'),
////                    'like_count' => Yii::t('app', 'sort_by_popular'),
//            ),
//            'sorterHeader' => Yii::t('app', 'Sort by'),
            'enableHistory' => true,
            'ajaxUpdate' => false,
        ));
        ?>
    </div>
</div>


