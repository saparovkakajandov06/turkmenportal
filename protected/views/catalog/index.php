<div class="row">
    <?php
    if (isset($modelCategory)) {
        $this->breadcrumbs = array_merge(
                $this->breadcrumbs, $modelCategory->getBreadcrumbs(false)
        );
    }
    $this->subCategoryModel = $modelCategory;
    $this->enable_mobile_banner_vtop1 = true;
    $this->is_inner_breadcrumb = false;
    ?>
</div>


<div class="row">
    <div class=" col-sm-12">
        <h1 class="categoryHeader"><?php echo $modelCategory->getName(); ?></h1>
    </div>
</div>



<?php
$sub_categories = $modelCategory->children;
if (isset($sub_categories) && count($sub_categories) > 0 && $modelCategory->code != 'vacancy') {
    ?>
    <div class="row">
        <div class="col-sm-12">
            <?php
            $this->widget('application.widgets.category.CategorySubMenuWidget', array(
                'category_id' => $modelCategory->id,
                'itemCssClass' => 'col-sm-6 col-md-3',
                'wrapperCssClass' => 'row sub_categories horizontal',
                'relatedActiveRecord'=>'Catalog',
            ));
            ?>
        </div>
    </div>
<?php } ?>




<div class="row">
    <div class="col-md-12">
        <?php
//        $this->widget('application.widgets.banners.BannersWidget', array(
//            'type' => 'bannerSearchMain',
//            'outer_css_id' => 'bannerSearchMain',
//        ));
        ?>
    </div>
    <div class="col-sm-12">
        <?php
            if (isset($sub_categories) && count($sub_categories) > 0) {
                $this->widget('application.widgets.catalog.CatalogListviewWidget', array(
                    'count' => 5,
                    'parent_category_id' => $modelCategory->id,
//                    'parent_category_code' => $modelCategory->code,
                    'item_class' => 'col-sm-12',
                    'show_all' => false,
                    'show_photo' => true,
                    'itemView' => "_detailview",
                ));
            }
            else{
                 $this->widget('application.widgets.catalog.CatalogListviewWidget', array(
                    'count' => 5,
                    'category_id' => $modelCategory->id,
                    'item_class' => 'col-sm-12',
                    'show_all' => false,
                    'show_photo' => true,
                     'itemView' => "_detailview",
                ));
            }
        ?>
    </div>
</div>



