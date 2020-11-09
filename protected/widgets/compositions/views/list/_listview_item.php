

<div class="list-item ">
    <div class="entry-title">
        <?php
        $title = $data->getTitle();
        if(strlen($title)>5) { ?>
            <span class="entry-date"> <time datetime="<?php echo Yii::app()->controller->dateToW3C($data->date_added); ?>"> <?php echo Yii::app()->controller->renderDate($data->date_added); ?></time></span>
        <?php }
        echo CHtml::link(Yii::app()->controller->truncate($title, 15, 200), $data->url, array('alt' => $title, 'title' => $title,'rel' => 'bookmark'));
        ?>


    </div>
</div>