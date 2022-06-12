<?php if (!$this->isMobile()) { ?>


    <?php
    if (Yii::app()->controller->id == 'search') {
        ?>
        <div class="col-xl-12">
            <?php
            //                    $this->widget('BannersWidget', array(
            //                        'type' => 'bannerSearch1',
            //                        'outer_css_class' => 'colheight-sm-2 hidden-xs',
            //                        'outer_css_id' => 'banner2',
            //                    ));
            ?>
            <?php
            //                    $this->widget('BannersWidget', array(
            //                        'type' => 'bannerSearch2',
            //                        'outer_css_class' => 'colheight-sm-2 hidden-xs',
            //                        'outer_css_id' => 'banner2',
            //                    ));
            ?>
        </div>
    <?php } else { ?>
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

        <div class="style-media"></div>

        <div class="">
                <?php
                $this->widget('application.widgets.category.CategoryLinkWidget', array(
                    'category_code' => 'billboard',
                ));
                ?>

            <?php
            $this->widget('application.widgets.afishas.AfishaWidget', array(
                'category_code' => 'billboard',
                'randomLast' => 3,
            ));
            ?>
        </div>

        <div class="style-media">
            <?php
            $this->widget('application.widgets.category.CategoryLinkWidget', array(
                'category_code' => 'photoreport',
            ));
            ?>
            <?php
            $this->widget('application.widgets.compositions.CompositionOwlWidget', array(
                'item_count' => 1,
                'settings' => array(
                    array(
                        "thumbWidth" => 384,
                        "thumbHeight" => 435,
                        'cssClass' => "col-xs-12 colheight-sm-1 vertical-photoreport"
                    ),
                    array(
                        "thumbWidth" => 385,
                        "thumbHeight" => 435,
                        'cssClass' => "col-xs-12 colheight-sm-1 vertical-photoreport"
                    ), array(
                        "thumbWidth" => 385,
                        "thumbHeight" => 435,
                        'cssClass' => "col-xs-12 colheight-sm-1 vertical-photoreport"
                    ), array(
                        "thumbWidth" => 385,
                        "thumbHeight" => 435,
                        'cssClass' => "col-xs-12 colheight-sm-1 vertical-photoreport"
                    ),
                ),
                //                'item_class' => 'col-sm-6 col-md-6',
            ));
            ?>
        </div>


        <div class="style-media"></div>

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
    <?php } ?>
<?php } ?>