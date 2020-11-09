<?php
$document = $data->getDocument();
if (isset($document)) {
    ?>

    <article class="entry style-media media type-post">
        <?php

        if (isset($document) && $document->getVideoPath()) {
            $this->widget('application.widgets.videojs.VideoJs', array (
                'item_class' => 'entry-thumbnail',
                'document' => $document,
                'width' => '550',
            ));
        } else {
            $thumb = $document->resize(550, 450, 'w', true);
            if (isset($thumb) && strlen(trim($thumb)) > 0) { ?>
                <figure class="entry-thumbnail " style="display: inline; position: relative">
                    <?php echo CHtml::link(CHtml::image($thumb), $data->getUrl(), array ('class' => "thumb")); ?>
                    <?php if ($data->hasRelatedVideo()) { ?>
                        <span class="tp-play-icon"><i class="fa fa-play-circle"></i></span>
                    <?php } ?>
                </figure>
            <?php } ?>
        <?php } ?>


        <header class="entry-header">
            <h4 class="entry-title">
                <?php
                $title = $data->getTitle();
                $title = strip_tags($title);
                echo CHtml::link($title, $data->url, array ('alt' => $title, 'rel' => 'bookmark'));
                ?>
            </h4>

            <div class="entry-meta article_stats ">
                <time class="composition_date" itemprop="dateCreated"
                      datetime="<?php echo Yii::app()->controller->dateToW3C($data->date_added); ?>"><?php echo Yii::app()->controller->renderDateToWord($data->date_added); ?></time>
                <div class="composition_date post-item__views"><i
                        class="fa fa-eye"></i><span><?php echo $data->visited_count; ?></span></div>
            </div>
        </header>


        <div class="post-content">
            <?php
            $content = $data->getText();
            $content = strip_tags($content);
            $content = Yii::app()->controller->truncate($content, 25, 400);
            echo $content;
            ?>
        </div>
    </article>
<?php } ?>
<?php
if (Yii::app()->controller->isMobile()) {
    if (isset($index) && ($index == Yii::app()->controller->adsense_listview_index || $index == Yii::app()->controller->adsense_listview_index2)) { ?>
        <?php
        $this->widget('application.widgets.banners.BannersWidget', array (
            'type' => 'listviewAd',
            'outer_css_class' => 'entry style-media media type-post',
            'outer_css_id' => 'listviewAd',
        ));
        ?>
    <?php } ?>
<?php } ?>