<div class="<?php echo $this->item_class; ?> col-padding-reset">

    <?php
    $with_banner = false;
    if (isset($index) && $index == 5) {
        $bannerType = BannerType::model()->findByAttributes(array ('type_name' => 'bannerF', 'status' => 1));
        if (isset($bannerType)) {
            $with_banner = true;
            $this->widget('application.widgets.banners.BannersWidget', array (
                'type' => 'bannerF',
                'outer_css_id' => 'bannerF',
            ));
        }
    }

    if ($with_banner == false) {
        $title = $data->getTitle();
        ?>
        <?php if ($this->show_image && !Yii::app()->controller->isMobile()) { ?>
            <span class="media-object responsive">
            <?php echo CHtml::link(CHtml::image($data->getThumbPath(180, 265, 'w', true), $title, array ('alt' => $title)), $data->url, array ('class' => "thumb")); ?>
        </span>
        <?php } ?>


        <div class="style-media-list">

            <?php if ($this->show_title) { ?>
                <h3 class="entry-title">
                 <span class="entry-date">
                        <time
                            datetime="<?php echo Yii::app()->controller->dateToW3C($data->date_added); ?>"> <?php echo Yii::app()->controller->renderDate($data->date_added); ?></time>
                    </span>
                    <?php
                    echo CHtml::link(Yii::app()->controller->truncate($title, 20, 400), $data->url, array ('title' => $title, 'rel' => 'bookmark'));
                    ?>
                </h3>
            <?php } ?>
        </div>
    <?php } ?>
</div>