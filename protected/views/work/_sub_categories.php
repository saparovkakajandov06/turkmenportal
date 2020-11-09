<div class="row box_header_index">
    <span class="headerColor mini"><?php echo Yii::t('app','categories');?></span>
</div> 

<div class="sub_categories">
        <?php
            $sub_categories=$modelCategory->children;
            if(isset ($sub_categories) && count($sub_categories)>0){
                echo "<ul>";
                foreach ($sub_categories as $sub_category) {
                    $subcatModel=Category::model()->findByPk($sub_category->id);
                    echo "<li>".CHtml::link($subcatModel->name,Yii::app()->createUrl('//catalog/category',array('category_id'=>$subcatModel->id)))."</li>";
                }
                echo "</ul>";
            }
        ?>
     
        <div class="row box_header_index">
                <span class="headerColor mini"><?php echo Yii::t('app','latest_news');?></span>
        </div>
         <?php
            $this->widget('LentaNewsWidget', array(
                'count' => 10,
                'category_code' => 'news',
                'item_class' => 'col-sm-12 col-md-12',
                'show_all'=>false,
            ));
        ?>
</div>

<div class="row box_header_index">
    <span class="headerColor mini"><?php echo Yii::t('app', 'poll'); ?> </span>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="grid_block_15">
            <?php $this->widget('PollsWidget', array()); ?>
        </div>
    </div>
</div>