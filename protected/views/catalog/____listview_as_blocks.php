<article class=" col-xs-12 col-md-6 col-xl-4 colheight-index">

    <div class="media-body">
        <div class="image_wrapper clearfix">
            <span class="media-object pull-left">
                <a href="single.html" rel="bookmark" class="thumb"><?php echo $data->getThumbAsGallery(200, 200); ?></a>
            </span>
        </div>

        <?php
//        $category = $data->getMixedCategoryModel();
        if (isset($category)) {
            ?>
            <span class="category">
            <?php
                echo CHtml::link($category->getMixedDescriptionModel()->name, Yii::app()->createUrl('//catalog/category',array('category_id'=>$category->id)));
            ?></span>
        
        <?php } ?>

        <div class="entry-meta">
            <?php
            if (!empty($data->date_modified)) {
                $date = new DateTime($data->date_modified);
                ?>
            <?php } ?>
        </div>
        
        
        <?php 
        $description=$data->getMixedDescriptionModel();
        if (isset ($description)) { ?>
            <p class="entry-title">
                <span class="entry-date"><?php //echo $date->format("M-d-Y"); ?></span>
                <?php echo CHtml::link($description->title, Yii::app()->createUrl("//catalog/view", array('id' => $data->id)), array('rel' => 'bookmark')); ?>
            </p>
        <?php } ?>


    </div>

</article> 