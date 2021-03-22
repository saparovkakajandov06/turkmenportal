<?php
foreach ($blogModels as $key => $data) { ?>
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
            <div>
                <div class="media-body">
                    <div class="entry-title">
                    <span class="entry-date">
                        <time
                                datetime="<?php echo Yii::app()->controller->dateToW3C($data->date_added); ?>"> <?php echo Yii::app()->controller->renderDate($data->date_added); ?></time>
                    </span>
                        <?php
                        $title = Yii::app()->controller->truncate($title, 20, 300);
                        if ($data->is_photoreport == true)
                            $title .= ' <i class="fa fa-camera title"></i>';
                        echo CHtml::link($title, $data->url, array('title' => $title, 'rel' => 'bookmark'));
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php if ($key == 2) {
        $bannerType = BannerType::model()->findByAttributes(array('type_name' => 'mobileBannerB', 'status' => 1));
        if (isset($bannerType) && Yii::app()->controller->isMobile()) { ?>
            <div class="list-item inline-block type-post ">
                <div class="mobile-responsive visible-xs" style="margin-bottom:7px">
                    <?php
                    $this->widget('application.widgets.banners.BannersWidget', array(
                        'type' => 'mobileBannerB',
                        'outer_css_id' => 'mobileBannerB',
                    ));
                    ?>
                </div>
            </div>
        <?php } ?>
    <?php } ?>

<?php } ?>