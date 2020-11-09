<div class="row">
    <?php
    if (isset($modelCategory)) {
        $this->breadcrumbs = array_merge(
                $this->breadcrumbs, $modelCategory->getBreadcrumbs(true)
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
    <?php if ($modelCategory->code == 'billboard') { ?>
        <div class="row box_header_index">
            <span class="headerColor mini"><?php echo Yii::t('app', 'future_afishas'); ?></span>
        </div>
        <?php
        $this->widget('AfishaListviewWidget', array(
            'count' => 20,
            'is_tableview' => true,
            'parent_category_code' => 'billboard',
            'beforeToday' => 0,
            'show_all' => false,
            'item_class' => 'col-sm-12 col-md-12',
        ));
        ?>

        <div class="row box_header_index">
            <span class="headerColor mini"><?php echo Yii::t('app', 'past_afishas'); ?></span>
        </div>
        <?php
        $this->widget('AfishaListviewWidget', array(
            'count' => 20,
            'is_tableview' => true,
            'parent_category_code' => 'billboard',
            'beforeToday' => 1,
            'show_all' => false,
            'item_class' => 'col-sm-12 col-md-12',
        ));
    }
    
    else {
        foreach ($sub_categories as $key => $subcatModel) {
            if ($key == 10)
                break;

            $this->widget('application.widgets.catalog.CatalogListviewWidget', array(
                'count' => 12,
                'category_id' => $subcatModel->id,
                'item_class' => 'col-sm-6 col-md-6',
                'show_all' => true,
                'show_header' => true,
            ));
        }
    }
    ?>
</div>
</div>
<?php // } else{ ?>

<!--        <div class="col-sm-9">
                <div class="dynamic_pages">
<?php
//                        $this->widget('application.widgets.catalog.CatalogListviewWidget', array(
//                            'count' => 20,
//                            'is_tableview' => true,
//                            'category_id' => $modelCategory->id,
//                            'item_class' => 'col-sm-12 col-md-12',
//                            'show_all'=>false,
//                            'show_header' => true,
//                        ));
?>
                </div>
        </div>-->
<?php // } ?>


