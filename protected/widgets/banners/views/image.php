<!--noindex-->
<?php $this->beginWidget('DNofollowWidget'); ?>

<div id="<?php echo $this->outer_css_id; ?>" class="<?php echo $this->outer_css_class; ?>">
    <?php
    if (isset($bannerModel)) {
        if (isset($bannerModel->url) && strlen(trim($bannerModel->url)) > 3) {
            $fullUrl = (strpos($bannerModel->url, 'http') === false) ? "http://" . $bannerModel->url : $bannerModel->url;
            $fullUrl = Yii::app()->createUrl("banner/leave", array("url" => $fullUrl, 'banner_id' => $bannerModel->id));
            echo CHtml::link(
                CHtml::image(Documents::model()->getUploadedPath($bannerModel->getDocument()->path), $bannerModel->description, array('width' => $this->width, 'height' => $this->height, 'style' => $this->inner_css_style)), $fullUrl, array('target' => "_blank", "rel" => "nofollow", "class" => $this->link_css_class));
        } else
            echo CHtml::image(Documents::model()->getUploadedPath($bannerModel->getDocument()->path), $bannerModel->description, array('width' => $this->width, 'height' => $this->height, 'style' => $this->inner_css_style));
    } ?>
</div>

<?php $this->endWidget(); ?>
<!--/noindex-->
