<div class="col-xl-12">
    <?php
    $this->widget('application.widgets.banners.BannersWidget', array(
        'type' => 'bannerC',
        'outer_css_class' => 'hidden-xs',
        'outer_css_id' => 'banner2',
        'ajax' => true,
    ));
    ?>

    <div style="margin-top:10px">
        <?php
        $this->widget('application.widgets.banners.BannersWidget', array(
            'type' => 'bannerD',
            'outer_css_id' => 'bannerD',
        ));
        ?>
    </div>
</div>





<div style="text-align: center">
    <?php
    $this->widget('BannersWidget', array(
        'type' => 'bannerLeftView',
        'outer_css_class' => 'hidden-xs',
    ));
    ?>
</div>
<div style="text-align: right">
    <?php
    $this->widget('BannersWidget', array(
        'type' => 'bannerRightViewAdsense',
        'outer_css_class' => 'hidden-xs',
    ));
    ?>
</div>


<div style="text-align: right">
    <?php
    $this->widget('BannersWidget', array(
        'type' => 'bannerYandex',
        'outer_css_class' => 'hidden-xs',
        'outer_css_id' => 'bannerYandex',
    ));
    ?>
</div>