<div class="row">
    <?php
    if (isset($modelCategory)) {
        $this->breadcrumbs = array_merge(
                $this->breadcrumbs, $modelCategory->getBreadcrumbs(false)
        );
    }
    ?>
</div>


<div class="row">
    <div class=" col-sm-12">
        <h1 class="categoryHeader"><?php echo $modelCategory->getName(); ?></h1>
    </div>
</div>



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
            ));
            ?>
        </div>
    </div>
<?php } ?>




<div class="row">
    <div class="col-sm-12">
        <?php
       
        
            if (isset($sub_categories) && count($sub_categories) > 0) {
                $this->widget('application.widgets.catalog.CatalogListviewWidget', array(
                    'count' => 10,
                    'parent_category_id' => $modelCategory->id,
                    'item_class' => 'col-sm-12',
                    'show_all' => false,
                    'show_photo' => true,
                    'itemView' => "_detailview",
                ));
            }else{
                 $this->widget('application.widgets.catalog.CatalogListviewWidget', array(
                    'count' => 10,
                    'category_id' => $modelCategory->id,
                    'item_class' => 'col-sm-12',
                    'show_all' => false,
                    'show_photo' => true,
                     
                ));
            }
        ?>
    </div>
</div>



