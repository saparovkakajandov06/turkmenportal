<div class="row box_header_index">
    <span class="headerColor mini"><?php echo Yii::t('app','categories');?></span>
</div> 

<div class="sub_categories">
        <?php
            $sub_categories=$modelCategory->children;
            if(isset ($sub_categories) && count($sub_categories)>0){
                echo "<ul>";
                foreach ($sub_categories as $sub_category) {
                    $subcatModel=Category::model()->with_description()->findByPk($sub_category->id);
                    echo "<li>".CHtml::link($subcatModel->name,Yii::app()->createUrl('//estates/category',array('category_id'=>$subcatModel->id)))."</li>";
                }
                echo "</ul>";
            }
        ?>
</div>
