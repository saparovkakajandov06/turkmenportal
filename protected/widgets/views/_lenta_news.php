



<article class="type-post style-media-list media lenta_news <?php echo $this->item_class; ?> colheight-index">
        <div class="media-body">
                <h3 class="entry-title lenta">
                        <span class="entry-date"> <time datetime="<?php echo Yii::app()->controller->dateToW3C($data->date_added); ?>"> <?php echo Yii::app()->controller->renderDate($data->date_added); ?></time></span>
                        <?php 
                            $title=$data->getTitle();
                            echo CHtml::link(Yii::app()->controller->truncate($title,15,200), Yii::app()->createUrl("//blog/view", array('id' => $data->id)), array('alt'=>$title,'title' => $title,'rel' => 'bookmark'));
                        ?>
                </h3>
        </div>
</article>