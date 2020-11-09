<div class="row">
    <?php
        $this->page_name=Yii::t('app', 'News');    

        $this->breadcrumbs = array_merge(
                $this->breadcrumbs, 
                $modelCategory->getBreadcrumbs(true)
        );
        $this->page_name=$modelCategory->name;
    ?>
    
    <div class="col-sm-2 hidden-xs">
        <?php
            $this->renderPartial('//blog/_sub_categories', array('modelCategory' => $modelCategory->parent));
        ?>
    </div>
    
    <div class="col-sm-10">
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
</div>