<article class="entry style-media borderless media type-post">


    <?php if (Yii::app()->controller->isMobile()) { ?>
        <header class="entry-header">
            <h4 class="entry-title">
                <?php
                $title = $data->getTitle();
                $title = strip_tags($title);
                echo CHtml::link($title, $data->url, array('alt' => $title, 'rel' => 'bookmark'));
                ?>
            </h4>

            <div class="entry-meta article_stats ">
                <time class="composition_date" itemprop="dateCreated"
                      datetime="<?php echo Yii::app()->controller->dateToW3C($data->date_added); ?>"><?php echo Yii::app()->controller->renderDateToWord($data->date_added); ?></time>
                <div class="composition_date post-item__views"><i
                            class="fa fa-eye"></i><span><?php echo $data->visited_count; ?></span></div>
            </div>
        </header>

        <?php
        $thumb = $data->getThumbPath(550, 550, 'w', true);
        if (isset($thumb) && strlen(trim($thumb)) > 0) { ?>
            <figure class="entry-thumbnail mobile-responsive">
                <?php echo CHtml::link(CHtml::image($thumb), $data->getUrl(), array('class' => "thumb")); ?>
            </figure>
        <?php } ?>
    <?php } else {
        $thumb = $data->getThumbPath(150, 150, 'w', true);
        if (isset($thumb) && strlen(trim($thumb)) > 0) { ?>
            <figure class="entry-thumbnail compositions">
                <?php echo CHtml::link(CHtml::image($thumb), $data->getUrl(), array('class' => "thumb")); ?>
            </figure>
        <?php } ?>

        <header class="entry-header">
            <h4 class="entry-title">
                <?php
                $title = $data->getTitle();
                $title = strip_tags($title);
                echo CHtml::link($title, $data->url, array('alt' => $title, 'rel' => 'bookmark'));
                ?>
            </h4>

            <div class="entry-meta article_stats ">
                <time class="composition_date" itemprop="dateCreated"
                      datetime="<?php echo Yii::app()->controller->dateToW3C($data->date_added); ?>"><?php echo Yii::app()->controller->renderDateToWord($data->date_added); ?></time>
                <div class="composition_date post-item__views"><i
                            class="fa fa-eye"></i><span><?php echo $data->visited_count; ?></span></div>
            </div>
        </header>
    <?php } ?>


    <div class="post-content">
        <?php
        $content = $data->getText();
        $content = strip_tags($content);
        $content = Yii::app()->controller->truncate($content, 25, 400);
        echo $content;
        ?>
    </div>
</article>


<?php
if (isset($index) && (($index+1) % 6 === 0 )) {
    $this->widget('application.widgets.banners.BannersWidget', array(
        'type' => 'desktopBannerLevel2',
        'outer_css_class' => 'entry style-media media type-post',
        'outer_css_style' => 'margin-top:25px',
        'outer_css_id' => 'desktopBannerLevel2',
    ));
}

if (isset($index) && ($index == Yii::app()->controller->adsense_listview_index2)) { ?>
    <?php
    $this->widget('application.widgets.banners.BannersWidget', array(
        'type' => 'listviewAd',
        'outer_css_class' => 'entry style-media media type-post',
        'outer_css_id' => 'listviewAd',
        'outer_css_style' => 'margin-top:25px',
    ));
    ?>
<?php } ?>

<?php
if (isset($index) && (($index+1) % 6 === 0 )) { ?>
    <?php
    $this->widget('application.widgets.banners.BannersWidget', array(
        'type' => 'mobileBannerLevel2',
        'outer_css_class' => 'entry style-media media type-post mobile-responsive visible-xs',
        'outer_css_style' => 'margin-top:25px',
        'outer_css_id' => 'mobileBannerLevel2',
    ));
    ?>
<?php } ?>
