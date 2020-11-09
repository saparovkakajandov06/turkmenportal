<div class="list-item <?php echo $this->item_class; ?>">
    <div class="lenta">
        <div class="entry-meta ">
            <time class="composition_date" itemprop="dateCreated"
                  datetime="<?php echo Yii::app()->controller->dateToW3C($data->date_added); ?>"><?php echo Yii::app()->controller->renderDateToWord($data->date_added); ?></time>
            <div class="composition_date post-item__views"><i
                    class="fa fa-eye"></i><span><?php echo $data->visited_count; ?></span></div>
        </div>
<!--        <span class="entry-date"> <time-->
<!--                datetime="--><?php //echo Yii::app()->controller->dateToW3C($data->date_added); ?><!--"> --><?php //echo Yii::app()->controller->renderDate($data->date_added); ?><!--</time></span>-->
        <?php
        $title = $data->getTitle();
        echo CHtml::link(Yii::app()->controller->truncate($title, 15, 200), $data->url, array('title' => $title, 'rel' => 'bookmark'));
        ?>
    </div>
</div>
