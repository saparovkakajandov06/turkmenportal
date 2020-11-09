<!--noindex-->
<?php $this->beginWidget('DNofollowWidget'); ?>
<div id="<?php echo $this->outer_css_id; ?>" class="slider-wrapper theme-default">
    <?php

    foreach ($banners as $bannerModel) {
        $fullUrl = (strpos($bannerModel->url, 'http') === false) ? "http://" . $bannerModel->url : $bannerModel->url;
        $fullUrl = Yii::app()->createUrl("banner/leave", array("url" => $fullUrl, 'banner_id' => $bannerModel->id));
        $images[] = array(
            'src' => $bannerModel->getThumbPath($this->width, $this->height, 'auto', true),
            'url' => $fullUrl,
            'caption' => $bannerModel->description,
        );
    }

    $this->widget('application.extensions.nivoslider.ENivoSlider', array(
//            'htmlOptions'=>array('style'=>'width: '.$this->width.'px; height: '.$this->height.'px;'),
            'images' => $images
        )
    );

    ?>
</div>
<?php $this->endWidget(); ?>
<!--/noindex-->
