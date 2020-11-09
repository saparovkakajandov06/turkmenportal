 <article class="entry type-post style-thumbnail <?php echo $this->item_class; ?> ">
            <span class="category"><?php echo CHtml::link($data->getMixedCategoryModel()->name,Yii::app()->createUrl('//catalog/category',array('category_id'=>$data->category_id))); ?></span>
            <figure class="entry-thumbnail">
                <?php echo CHtml::link(CHtml::image($data->getThumbPath(190,190,true),$title), Yii::app()->createUrl("//catalog/view", array('id' => $data->id)), array( 'class'=>"thumb")); ?>
            </figure>
            
            <h3 class="entry-title">
                    <?php echo CHtml::link($data->getMixedDescriptionModel()->title,Yii::app()->createUrl('//catalog/view',array('id'=>$data->id)));?>
            </h3>
</article>