<?php
if (isset($modelCategory)) {
    $this->breadcrumbs = array_merge(
        $this->breadcrumbs, $modelCategory->getBreadcrumbs(true)
    );
}

$this->is_inner_breadcrumb = false;
$this->enable_mobile_banner_vtop1 = true;
?>

<div class="row">
    <div class="">
        <div class="level2_cont_inner">
            <div class="inner_breadcrumbs">
                <?php //$this->renderPartial('//layouts/frontend/tpl_breadcrumbs'); ?>
            </div>


            <div class="col-sm-3 level2_cont_left " style="
            border-right: 1px solid #DDDDDD;
            position: relative;
            left: 1px;">
                <div class="">
                    <?php $this->renderPartial('_search', array('model' => $modelEstates)); ?>
                </div>
            </div>


            <div class="col-sm-9 border-left level2_cont_right">
                <h1 class="categoryHeader"><?php echo $modelCategory->name; ?></h1>

                <?php
                $sub_categories = $modelCategory->children;
                if (isset($sub_categories) && count($sub_categories) > 0) {
                    ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <?php
                            $this->widget('application.widgets.category.CategorySubMenuWidget', array(
                                'category_id' => $modelCategory->id,
                                'itemCssClass' => 'col-sm-6 col-md-3',
                                'wrapperCssClass' => 'row sub_categories horizontal',
                                'relatedActiveRecord' => 'Estates',
                            ));
                            ?>
                        </div>
                    </div>
                <?php } ?>

                <div class="row">
                    <div class="col-md-12">
                        <?php
                        $this->widget('application.widgets.banners.BannersWidget', array(
                            'type' => 'bannerNesipetsin',
                            'outer_css_class' => 'mobile-responsive',
                        ));
                        ?>
                    </div>
                </div>

                <?php
                $this->widget('bootstrap.widgets.TbListView', array(
                    'dataProvider' => $modelEstates->searchForCategory(null),
                    'id' => 'estate-grid',

                    //    'viewData' => $this->item_class,
                    'itemView' => '_view',
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
                        'views' => Yii::t('app', 'sort_by_read'),
//                    'likes' => Yii::t('app', 'sort_by_popular'),
                    ),
                    'sorterHeader' => Yii::t('app', 'Sort by'),
                    'enableHistory' => true,
//                'ajaxUpdate' => false,
                ));

                ?>
            </div>
        </div>
    </div>
</div>


