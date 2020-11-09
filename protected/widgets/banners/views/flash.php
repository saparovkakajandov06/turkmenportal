<!--noindex-->
<?php $this->beginWidget('DNofollowWidget'); ?>

<div id="<?php echo $this->outer_css_id; ?>" class="<?php echo $this->outer_css_class; ?>">
    <?php
    $fullUrl = (strpos($bannerModel->url, 'http') === false) ? "http://" . $bannerModel->url : $bannerModel->url;
    $fullUrl = Yii::app()->createUrl("banner/leave", array("url" => $fullUrl, 'banner_id' => $bannerModel->id));
    ?>
    <a href="<?php echo $fullUrl; ?>" rel="nofollow" target="_blank"
       style="position: absolute; width: 100%; height: 100%"> </a>
    <object width="<?php echo $this->width; ?>" height="<?php echo $this->height; ?>">
        <param name="movie"
               value="<?php echo Documents::model()->getUploadedPath($bannerModel->getDocument()->path); ?>">
        <param name="quality" value="high">
        <embed quality="high" type="application/x-shockwave-flash" width="<?= $this->width ?>"
               height="<?= $this->height ?>">
    </object>
</div>

<?php $this->endWidget(); ?>
<!--/noindex-->
