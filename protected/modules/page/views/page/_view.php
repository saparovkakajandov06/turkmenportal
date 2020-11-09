 <div class="col-md-4 colheight-sm-1">
    
    <span class="media-object responsive" >
            <?php echo CHtml::link(CHtml::image($data->getThumbPath(80,80,'auto',true),$title), $data->url, array('class'=>"thumb")); ?>
    </span>
    <div class="article_category">
        <?php 
            if(isset($data->category_id))
                echo CHtml::link($data->category->name, $data->category->url, array('rel' => 'bookmark')); 
        ?>
    </div>
    <div class="entry-title bottom-news">
        <?php
        $title = $data->getTitle();
        echo CHtml::link(Yii::app()->controller->truncate($title, 25, 300), $data->url, array('alt' => $title, 'rel' => 'bookmark'));
        ?>
    </div>
</div>