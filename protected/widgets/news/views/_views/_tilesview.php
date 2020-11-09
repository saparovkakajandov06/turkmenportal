 <div class="<?php echo $this->item_class; ?> box_content_tile">
    
    <span class="media-object responsive" >
            <?php echo CHtml::link(CHtml::image($data->getThumbPath(210,115,'auto',true),$title), $data->url, array('class'=>"thumb")); ?>
    </span>
     
    <div class="style-media-list">
        <h3 class="entry-title">
            <?php
                $title = $data->getTitle();
                echo CHtml::link(Yii::app()->controller->truncate($title, 20, 400), $data->url, array('alt' => $title,'title' => $title, 'rel' => 'bookmark'));
            ?>
        </h3>
        <p class="entry-description">
            <?php
            $content = strip_tags($data->getText());
            echo CHtml::link(Yii::app()->controller->truncate($content, 23, 420), $data->url, array('alt' => $title, 'title' => $title,'rel' => 'bookmark'));
            ?>
        </p>
    </div>
            
</div>