<div class="row">
    <?php
    $this->page_name=Yii::t('app', 'News');    
  
    $this->breadcrumbs = array_merge(
            $this->breadcrumbs, 
            $modelCategory->getBreadcrumbs(true)
    );
    
    $sub_categories = $modelCategory->children;
    if (isset($sub_categories) && count($sub_categories) > 0) {
        ?>
    
<!--        <div class="col-sm-2 left_category_panel">
            <?php
//                $this->renderPartial('//blog/_sub_categories', array('modelCategory' => $modelCategory));
            ?>
        </div>-->


        <div class="col-sm-12">
                <div class="dynamic_pages">
                    
                    <?php
                        $this->widget('application.widgets.news.NewsIndexWidget', array(
                            'count' => 15,
                            'item_class' => 'col-sm-6 col-md-6',
                        ));
                    ?>
                    
                    
                    <div class="box_header_index">
                        <h1 class="categoryHeader"><?php echo Yii::t('app','latest_news'); ?></h1>
                    </div>
                     <?php
                        $this->widget('BlogListviewWidget', array(
                            'count' => 12,
                            'category_code' => 'news',
                            'item_class' => 'col-sm-6 col-md-6',
                            'show_all'=>false,
                        ));
                    ?>
                    
                    <?php
                    foreach ($sub_categories as $key => $subcatModel) {
                        if ($key == 6)
                            break;
                        
                        ?> <div class="box_header_index">
                                <h2 class="categoryHeader">
                                    <?php echo CHtml::link($subcatModel->name, $subcatModel->url, array('class' => "headerColor mini")); ?> 
                                </h2>
                        </div> <?php
                        $this->widget('BlogListviewWidget', array(
                            'count' => 12,
                            'category_id' => $subcatModel->id,
                            'item_class' => 'col-sm-6 col-md-6',
                            'show_all' => true,
                        ));
                    }
                    ?>
                </div>
        </div>
    <?php } else{ 
//            $this->breadcrumbs = array(
//                $modelCategory->parent->getMixedDescriptionModel()->name => array('//blog/category','category_id'=>$modelCategory->parent_id),
//                $modelCategory->name,
//            );
        ?>
        <div class="col-sm-3 hidden-xs">
            <?php
                $this->renderPartial('//blog/_sub_categories', array('modelCategory' => $modelCategory->parent));
            ?>
        </div>
    
        <div class="col-sm-9">
                <div class="dynamic_pages">
                    <div class="">
                        <h2 class="box_header_index">
                            <?php echo CHtml::link($modelCategory->name, $modelCategory->url, array('class' => "headerColor")); ?>
                        </h2>
                    </div>
                     <?php
                        $this->widget('BlogListviewWidget', array(
                            'count' => 40,
                            'category_id' => $modelCategory->id,
                            'item_class' => 'col-sm-12 col-md-12 blog-level-3',
                            'show_all'=>false,
                            'is_truncate'=>false,
                        ));
                    ?>
                </div>
        </div>
    <?php }
    ?>
</div>


