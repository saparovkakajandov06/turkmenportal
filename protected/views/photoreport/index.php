<?php
$this->breadcrumbs = array_merge(
    $this->breadcrumbs, $modelCategory->getBreadcrumbs(true)
);
$this->enable_mobile_banner_vtop1 = true;
$this->is_inner_breadcrumb = true;
$this->subCategoryModel = $modelCategory;
?>

<div class="row">
    <?php
    //        $this->page_name=Yii::t('app', 'News');
    //
    //        $this->breadcrumbs = array_merge(
    //                $this->breadcrumbs,
    //                $modelCategory->getBreadcrumbs(true)
    //        );
    //        $this->page_name=$modelCategory->name;
    ?>

    <div class="col-sm-3">
        <?php $this->renderPartial('//layouts/common/column2_left'); ?>
    </div>


    <div class="col-sm-9 border-left level2_cont_right">
        <h1 class="categoryHeader">
            <?php
            $title = $modelCategory->name;
            if (isset($modelBlog->pub_date) && strlen(trim($modelBlog->pub_date)) > 0) {
                $title .= "(" . $modelBlog->pub_date . ")";
            }
            echo $title;
            ?>
        </h1>

        <?php
        $this->widget('bootstrap.widgets.TbListView', array(
            'dataProvider' => $modelPhotoreport->searchForCategory(null),
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
            'sorterCssClass' => 'auto_sorter',
            'sortableAttributes' => array(
                'date_added' => Yii::t('app', 'sort_by_date'),
                'visited_count' => Yii::t('app', 'sort_by_read'),
//                         'like_count' => Yii::t('app', 'sort_by_popular'),
            ),
            'sorterHeader' => Yii::t('app', 'Sort by'),
            'enableHistory' => true,
            'ajaxUpdate' => false,
        ));

        //                    $this->widget('BlogListviewWidget', array(
        //                        'count' => 40,
        //                        'category_id' => $modelCategory->id,
        //                        'item_class' => 'col-sm-12 col-md-12 blog-level-3',
        //                        'show_all'=>false,
        //                        'is_truncate'=>false,
        //                    ));
        ?>
    </div>
</div>