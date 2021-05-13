<div class="<?php echo $this->item_class; ?> col-padding-reset">

    <?php
    $with_banner = false;
    if (isset($index) && $index == 5) {
        $bannerType = BannerType::model()->findByAttributes(array('type_name' => 'composition_index_ad', 'status' => 1));
        if (isset($bannerType)) {
            $with_banner = true;
            $this->widget('application.widgets.banners.BannersWidget', array(
                'type' => 'composition_index_ad',
                'outer_css_id' => 'composition_index_ad',
            ));
        }
    }

    if ($with_banner == false) {
        $title = $data->getTitle();
        ?>
        <?php if ($this->show_image && !Yii::app()->controller->isMobile()) { ?>
            <span class="media-object responsive">
            <?php echo CHtml::link(CHtml::image($data->getThumbPath(180, 265, 'w', true), $title, array('alt' => $title)), $data->url, array('class' => "thumb lazy", 'width' => '180', 'height' => '265')); ?>
        </span>
        <?php } ?>


        <div class="style-media-list">

            <?php if ($this->show_title) { ?>
                <h3 class="entry-title">
                    <?php
                    echo CHtml::link(Yii::app()->controller->truncate($title, 20, 400), $data->url, array('title' => $title, 'rel' => 'bookmark'));
                    ?>
                </h3>
            <?php } ?>

            <?php if ($this->show_description) { ?>
                <p class="entry-description">
                    <?php
                    $content = strip_tags($data->getContent());
                    echo CHtml::link(Yii::app()->controller->truncate($content, 20, 400), $data->url, array('rel' => 'bookmark'));
                    ?>
                </p>
            <?php } ?>
        </div>
    <?php } ?>
</div>