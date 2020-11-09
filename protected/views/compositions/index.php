<?php
$this->breadcrumbs = array_merge(
    $this->breadcrumbs, $modelCategory->getBreadcrumbs(true)
);
$this->is_inner_breadcrumb = true;
$this->subCategoryModel = $modelCategory;
$this->enable_mobile_banner_vtop1 = true;

?>


<div class="row">

    <div class="col-sm-3 col-xs-12">
        <?php $this->renderPartial('//layouts/common/column2_left'); ?>
    </div>

    <div class="col-sm-9 col-xs-12 border-left level2_cont_right">
        <h1 class="categoryHeader"><?php echo $modelCategory->name; ?></h1>

        <?php
        $this->widget('bootstrap.widgets.BootListView', array(
            'dataProvider' => $compositionsModel->searchForIndex(null, false),
            'itemView' => '_view',
            'summaryText' => false,
//                    'pagerCssClass' => "pagination2",
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
//                    'sorterCssClass'=>'auto_sorter',
//                    'sortableAttributes'=>array(
//                        'date_added'=>Yii::t('app','sort_by_date'),
//                        'views'=>Yii::t('app','sort_by_read'),
////                        'likes'=>Yii::t('app','sort_by_popular'),
//                    ),
//                    'sorterHeader'=>Yii::t('app', 'Sort by'),
            'enableHistory' => true,
            'ajaxUpdate' => false,
            'htmlOptions' => array('class' => ''),
        ));
        ?>
    </div>
</div>