 <div class="sub_categories">
        <?php
            $sub_categories=$modelCategory->children;
            if(isset ($sub_categories) && count($sub_categories)>0){
                echo "<ul>";
                foreach ($sub_categories as $sub_category) {
                    $subcatModel=Category::model()->with_description()->findByPk($sub_category->id);
                    echo "<li>".CHtml::link($subcatModel->name,Yii::app()->createUrl('//category/category',array('category_id'=>$subcatModel->id)))."</li>";
                }
                echo "</ul>";
            }
        ?>
     
        <div class="row box_header_index">
                <?php echo CHtml::link(Yii::t('app','latest_news'), "#", array('class' => "headerColor")); ?>
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