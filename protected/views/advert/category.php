<div class="row">
    <?php
        
    $sub_categories = $modelCategory->children;
   
    if (isset($sub_categories) && count($sub_categories) > 0) {
            $this->breadcrumbs = array(
                $modelCategory->getMixedName(),
            );
        ?>
        <div class="col-sm-3">
            <?php
                $this->renderPartial('//catalog/_sub_categories', array('modelCategory' => $modelCategory));
            ?>
        </div>


        <div class="col-sm-9">
             
                <div class="row box_header_index">
                    <h1 class="categoryHeader"><?php echo $modelCategory->getMixedName(); ?></h1>
                </div>

                <div class="dynamic_pages"> 
                   
                    <?php
                    if($modelCategory->code=='billboard'){ ?>
                        <div class="row box_header_index">
                            <span class="headerColor mini"><?php echo Yii::t('app','future_afishas'); ?></span>
                        </div>
                        <?php 
                        $this->widget('AfishaListviewWidget', array(
                            'count' => 20,
                            'is_tableview' => true,
                            'parent_category_code' => 'billboard',
                            'beforeToday'=>0,
                            'show_all'=>false,
                            'item_class' => 'col-sm-12 col-md-12',
                        )); ?>
                    
                        <div class="row box_header_index">
                            <span class="headerColor mini"><?php echo Yii::t('app','past_afishas'); ?></span>
                        </div>
                        <?php
                        $this->widget('AfishaListviewWidget', array(
                            'count' => 20,
                            'is_tableview' => true,
                            'parent_category_code' => 'billboard',
                            'beforeToday'=>1,
                            'show_all'=>false,
                            'item_class' => 'col-sm-12 col-md-12',
                        ));
                    }else{
                        foreach ($sub_categories as $key => $subcatModel) {
                            if ($key == 10)
                                break;

                            $this->widget('CatalogListviewWidget', array(
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
    <?php } else{ 
            $this->breadcrumbs = array();
//            if(isset($modelCategory->parent))
//                $this->breadcrumbs[]=array($modelCategory->parent->getMixedDescriptionModel()->name => array('//catalog/category','category_id'=>$modelCategory->parent_id));
//            if(isset($modelCategory))
//                $this->breadcrumbs[]=$modelCategory->getMixedDescriptionModel()->name;

            
        ?>
        <div class="col-sm-3">
            <?php
                $this->renderPartial('//catalog/_sub_categories', array('modelCategory' => $modelCategory->parent));
            ?>
        </div>
    
        <div class="col-sm-9">
                <div class="dynamic_pages">
                     <?php
                        $this->widget('CatalogListviewWidget', array(
                            'count' => 20,
                            'is_tableview' => true,
                            'category_id' => $modelCategory->id,
                            'item_class' => 'col-sm-12 col-md-12',
                            'show_all'=>false,
                            'show_header' => true,
                        ));
                    ?>
                </div>
        </div>
    <?php }
    ?>
</div>


