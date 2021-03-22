<div class="list-item inline-block type-post ">
    <div class="inner_block">
        <?php $title = $data->getTitle(); ?>
        <?php
        $path = $data->getThumbPath(510, 710, 'w', true);
        if (isset($path) && strlen(trim($path)) > 1) { ?>
            <span class="media-object responsive news-index">
                        <?php echo CHtml::link(CHtml::image($path, $title, array('style' => 'margin-right:15px;', 'alt' => $title)), $data->getUrl(), array('class' => "thumb")); ?>
                    </span>
        <?php } ?>

        <div class="media-body">
            <div class="entry-title">
                    <span class="entry-date">
                        <time
                            datetime="<?php echo Yii::app()->controller->dateToW3C($data->date_added); ?>"> <?php echo Yii::app()->controller->renderDate($data->date_added); ?></time>
                    </span>
                <?php
                $title = Yii::app()->controller->truncate($title, 20, 300);
                echo CHtml::link($title, $data->url, array('title' => $title, 'rel' => 'bookmark'));
                ?>
            </div>
        </div>
    </div>
</div>