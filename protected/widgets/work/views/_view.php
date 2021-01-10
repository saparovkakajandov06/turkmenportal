

<div class="type-post style-media-list media <?php echo $this->item_class; ?> col-xs-12 colheight-index">
    <div class="inner_block">
        <?php
        $title = $data->getTitle();
        ?>
        <div class="pull-left">
            <?php
            $path = $data->getThumbPath(110, 80, 'w', true, true, true);
            if (isset($path) && strlen(trim($path)) > 1) { ?>
                <span class="media-object responsive">
                        <?php echo CHtml::link(CHtml::image($path, $data->title, array('style' => 'margin-right:15px;', 'alt' => $title)), $data->getUrl(), array('class' => "thumb")); ?>
                    </span>
            <?php } ?>
        </div>

        <div class="media-body">

            <div class="entry-title right-news">
                <?php
                echo CHtml::link(Yii::app()->controller->truncate($title, 10, 170), $data->url,array('title' => $title));
                ?>
            </div>

            <div class="entry-title">
                <?php
                $title = $data->description;
                echo CHtml::link(Yii::app()->controller->truncate($title, 5, 100), $data->url, array('title' => $title,'rel' => 'bookmark'));
                ?>

                <div class="article_stats">
                    <time class="article_header_date"
                          datetime="<?php echo Yii::app()->controller->dateToW3C($data->date_added); ?>"><?php echo Yii::app()->controller->renderDateTime($data->date_added); ?></time>
                    <div class="post-item__views"><i class="icon-eye-open"></i><span><?php echo $data->views; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
