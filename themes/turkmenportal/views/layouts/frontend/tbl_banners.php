<!--noindex-->
<?php $this->beginWidget('DNofollowWidget'); ?>
<?php
$this->widget('application.widgets.banners.BannersWidget', array(
    'type' => 'bannerFonLeft',
    'outer_css_class' => '',
    'outer_css_id' => '',
    'outer_css_style' => 'position: fixed',
));
?>

<?php
$this->widget('application.widgets.banners.BannersWidget', array(
    'type' => 'bannerFonRight',
    'outer_css_class' => '',
    'outer_css_id' => '',
    'outer_css_style' => 'position: fixed;',
));
?>

<?php if (Yii::app()->controller->isMobile() && Yii::app()->controller->enable_mobile_banner_vtop1) { ?>
    <div class="">
        <div class="col-md-12 bg-base col-lg-12 col-xl-12">
            <div class="mobile-responsive visible-xs" style="margin-top: 15px; margin-bottom: 15px">
                <?php
                $this->widget('application.widgets.banners.BannersWidget', array(
                    'type' => 'mobileBannerVtop1',
                    'outer_css_id' => 'mobileBannerVtop1',
                ));
                ?>
            </div>
        </div>
    </div>
<?php } ?>

<?php if (Yii::app()->controller->isMobile() && Yii::app()->controller->enable_mobile_banner_vtop2) { ?>
    <div class="">
        <div class="col-md-12 bg-base col-lg-12 col-xl-12">
            <div class="mobile-responsive visible-xs" style="margin-top: 15px; margin-bottom: 15px">
                <?php
                $this->widget('application.widgets.banners.BannersWidget', array(
                    'type' => 'mobileBannerVtop2',
                    'outer_css_id' => 'mobileBannerVtop2',
                ));
                ?>
            </div>
        </div>
    </div>
<?php } ?>

<?php $this->endWidget(); ?>
<!--/noindex-->
