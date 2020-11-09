 <div class="col-md-3 box_content_tile">
    
    <span class="media-object responsive" >
            <?php echo CHtml::link(CHtml::image($data->getThumbPath(210,115,'auto',true),$title), $data->url, array('class'=>"thumb")); ?>
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
        echo CHtml::link(Yii::app()->controller->truncate($title, 15, 200), $data->url, array('alt' => $title, 'rel' => 'bookmark'));
        ?>


        <div class="article_stats">
            <time class="article_header_date" itemprop="dateCreated" datetime="<?php echo Yii::app()->controller->dateToW3C($data->date_added); ?>"><?php echo Yii::app()->controller->renderDateTime($data->date_added); ?></time>
        </div>
    </div>
            
</div>