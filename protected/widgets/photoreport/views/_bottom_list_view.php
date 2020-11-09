 <div class="col-md-2">
    
    <span class="media-object responsive" >
            <?php echo CHtml::link(Chtml::image($data->getThumbPath(185,150,'auto',true),$title), Yii::app()->createUrl("//blog/view", array('id' => $data->id)), array('class'=>"thumb")); ?>
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
        echo CHtml::link(Yii::app()->controller->truncate($title, 15, 200), Yii::app()->createUrl("//blog/view", array('id' => $data->id)), array('alt' => $title, 'rel' => 'bookmark'));
        ?>


        <div class="article_stats">
            <time class="article_header_date" itemprop="dateCreated" datetime="<?php echo Yii::app()->controller->dateToW3C($data->date_added); ?>"><?php echo Yii::app()->controller->renderDateTime($data->date_added); ?></time>
            <div class="post-item__views"><i class="icon-eye-open"></i><span><?php echo $data->visited_count; ?></span></div>
        </div>
    </div>
            
</div>