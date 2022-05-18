<?php
$itemAfishCarouselCssClass = uniqid('carousel_afisha');
?>

    <div class="<?= $itemAfishCarouselCssClass ?> afisha_wrapper" style="display: none">
        <?php
        if (isset($afishas) && is_array($afishas) && count($afishas) > 5) {

            if (Yii::app()->controller->isMobile()) { ?>
                <?php foreach ($afishas as $key => $data) { ?>

                    <?php if (isset($key) && $key == 1) {
                        $bannerType = BannerType::model()->findByAttributes(array('type_name' => 'mobileBannerE', 'status' => 1));
                        $temp =$bannerType->getEnabledBanners();
                        if (isset($bannerType) && count($temp) > 0) { ?>
                            <div class="afisha_view">
                                <div class="responsive">
                                    <?php
                                    $this->widget('application.widgets.banners.BannersWidget', array(
                                        'type' => 'mobileBannerE',
                                        'outer_css_id' => 'mobileBannerE',
                                        'width' => '100%',
                                        'height' => '225'
                                    )); ?>
                                </div>
                            </div>
                            <?php
                        }
                    } ?>

                    <?php $this->render('_afisha_view', array('data' => $data)); ?>
                <?php } ?>

            <?php } else {
                ?>
                <?php foreach ($afishas as $key => $data) { ?>
                    <?php $this->render('_afisha_view', array('data' => $data)); ?>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    </div>

<?php
Yii::app()->clientScript->registerScript('afisha_carousel_scripts', '
 function initAfishaCarousel(){
    var owlAfisha=$(".' . $itemAfishCarouselCssClass . '").owlCarousel({
        autoPlay: false,
        slideSpeed: 300,
        pagination: false,
        navigation: false,
        items: 4,
        itemsCustom: [
          [0, 1.38],
          [450, 1.5],
          [480, 1.8],
          [600, 2.5],
          [700, 2.7],
          [768, 3.3],
          [992, 3.8],
          [1199, 4.2]
        ],
        /* transitionStyle : "fade", */    /* [This code for animation ] */
        navigationText: [""],
//        navigationText : ["<i class=\'fa fa-arrow-left\'></i>","<i class=\'fa fa-arrow-right\'></i>"]
      });
      
      
      $(".afisha_wrapper").show(500);
  }
  
  initAfishaCarousel();

', CClientScript::POS_READY);

?>