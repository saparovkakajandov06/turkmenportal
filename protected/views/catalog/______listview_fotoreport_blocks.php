 <article class="entry type-post style-thumbnail col-xs-12">
            <span class="category"><?php echo CHtml::link($data->getMixedCategoryModel()->name,Yii::app()->createUrl('//catalog/category',array('category_id'=>$data->category_id))); ?></span>
             <h2 class="">
                    <?php echo CHtml::link($data->getMixedDescriptionModel()->title,Yii::app()->createUrl('//catalog/view',array('id'=>$data->id)));?>
            </h2>
            <figure class="entry-thumbnail">
                <a href="single.html">
                    <?php echo $data->getThumbAsGallery(500,500); ?>
                </a>
            </figure>
            
            
            <h4 class="entry-description">
                    <?php echo $data->getMixedDescriptionModel()->description; ?>
            </h4>
            
            <div class="row comment_tools">
                <div class="col-lg-2">
                </div>

                <div class="col-sm-offset-6 col-md-3">
                    <span class="like" data-qnt="<?php echo CHtml::encode($data->likes); ?>"> <?php echo CHtml::encode($data->likes); ?></span>
                    <span class="dislike" data-qnt="<?php echo CHtml::encode($data->dislikes); ?>"><?php echo CHtml::encode($data->dislikes); ?></span>
                </div>


                <div class="col-md-1">
                    <?php echo CHtml::link("like",'#', array('class'=>'like_button','data-comment_id'=>$data->id)); ?>
                    <?php echo CHtml::link("dislike","#", array('class'=>'dislike_button','data-comment_id'=>$data->id)); ?>
                </div>
            </div>
</article>  