<?php
$cssClass = 'col-xs-12 colheight-sm-1';
?>

<article class="entry style-grid style-hero hero-sm-largest type-post item_photoreport <?php echo $cssClass; ?>">
    <header class="entry-header">
        <h4 class="entry-title">
            <?php echo CHtml::link($data->getTitle(), $data->getUrl(), array('class' => 'banner_link')); ?>
        </h4>
    </header>

    <figure class="entry-thumbnail">
        <?php
        echo CHtml::link(CHtml::image($data->getThumbPath($thumbWidth, $thumbHeight, 'auto', true), $data->getTitle()), $data->getUrl(), array('class' => "overlay overlay-primary lazy", 'width' => $thumbWidth, 'height' => $thumbHeight));
        ?>
    </figure>

    <div class="entry-top">
        <?php
        if ($data->hasRelatedVideo()) { ?>
            <span class="c-video-play"></span>
        <?php } else { ?>
            <span class="c-photo__text__inner__gallcount">
<!--            <span class="c-photo__text__inner__gallcount__text">-->
                <?php //echo $data->documents_count; ?><!--</span>-->
    </span>
        <?php } ?>
    </div>

</article>