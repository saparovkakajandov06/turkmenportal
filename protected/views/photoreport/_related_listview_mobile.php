<div class="col-xs-12">
    <div class="list-item-related inline-block type-post ">
        <div class="inner_block">
            <?php $title = $data->getTitle(); ?>
            <div class="pull-left">
                <?php
                $path = $data->getThumbPath(175, 92, 'w', true);
                if (isset($path) && strlen(trim($path)) > 1) { ?>
                    <span class="media-object responsive news-index">
                        <?php echo CHtml::link(CHtml::image($path, $title, array('style' => 'margin-right:8px;', 'alt' => $title)), $data->getUrl(), array('class' => "thumb")); ?>
                    </span>
                <?php } ?>
            </div>
            <div class="media-body">
                <div class="entry-title">
                    <?php
                    $title = Yii::app()->controller->truncate($title, 10, 125);
                    if ($data->is_photoreport == true)
                        $title .= ' <i class="fa fa-camera title"></i>';
                    echo CHtml::link($title, $data->url, array ('title' => $title, 'rel' => 'bookmark'));
                    ?>
                </div>
                <div class="entry-meta ">
                    <time class="composition_date" itemprop="dateCreated"
                          datetime="<?php echo Yii::app()->controller->dateToW3C($data->date_added); ?>"><?php echo Yii::app()->controller->renderDateToWord($data->date_added); ?></time>
                    <div class="composition_date post-item__views"><i
                            class="fa fa-eye"></i><span><?php echo $data->visited_count; ?></span></div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php if (isset($index) && $index == 2) { ?>
    <div class="col-xs-12 list-item-related inline-block type-post ">
        <?php
        $this->widget('application.widgets.banners.BannersWidget', array(
            'type' => 'mobileBannerLevel3Related',
            'outer_css_class' => 'mobile-responsive visible-xs',
            'outer_css_id' => 'mobileBannerLevel3Related',
        ));
        ?>
    </div>
<?php } ?>