<div class="row">
    <div class="col-md-12 bg-base col-lg-12 col-xl-12">
        <div class="mobile-responsive visible-xs">
            <?php
            $this->widget('application.widgets.banners.BannersWidget', array(
                'type' => 'mobileBannerA',
                'outer_css_id' => 'mobileBannerA',
            ));
            ?>
        </div>
    </div>
</div>


<div class="row mobile_block block">
    <div class="col-md-12 bg-base col-lg-12 col-xl-12">
        <?php
        $this->widget('application.widgets.category.CategoryHeaderWidget', array(
            'maxSubCatCount' => 7,
            'category_code' => 'news',
            'categoy_index_url' => '//blog',
            'cssClass' => 'first',
//            'override_main_title' => Yii::t('app', 'tm_news')
        ));
        ?>
    </div>

    <div class="col-md-9 bg-base col-lg-9 col-xl-9 col-wide-right dashboard_news_block">
        <?php
        $this->widget('application.widgets.news.NewsIndexWidget', array(
            'count' => 7,
            'item_class' => 'col-sm-6 col-md-6',
            'parent_category_code' => 'news'
        ));
        ?>

        <?php
        $this->widget('application.widgets.banners.BannersWidget', array(
            'type' => 'bannerE',
            'outer_css_id' => 'banner1',
            'outer_css_style' => 'position: absolute;bottom: 0px;',
            'outer_css_class' => 'mobile-responsive hidden-sm',
        ));
        ?>
    </div>

    <div class="sidebar col-md-3 col-lg-3 col-xl-3 pull-right" style="width: 23%;">
        <?php
        $this->widget('application.widgets.banners.BannersWidget', array(
            'type' => 'bannerC',
            'outer_css_class' => 'hidden-sm',
            'outer_css_id' => 'banner2',
        ));
        ?>
        <div style="margin-top:10px">
            <?php
            $this->widget('application.widgets.banners.BannersWidget', array(
                'type' => 'bannerD',
                'outer_css_class' => 'hidden-sm',
                'outer_css_id' => 'banner2',
            ));
            ?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="more-wrapper visible-xs">
            <?php echo CHtml::link(Yii::t('app', 'more'), Yii::app()->controller->categoryUrl, array('class' => 'more-link')); ?>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12 bg-base col-lg-12 col-xl-12">
        <div class="mobile-responsive visible-xs">
            <?php
            $this->widget('application.widgets.banners.BannersWidget', array(
                'type' => 'mobileBannerC',
                'outer_css_id' => 'mobileBannerC',
            ));
            ?>
        </div>
    </div>
</div>


<div class="row mobile_block block">
    <div class="col-md-4">
        <?php
        $limitNewsList = 6;
        if (Yii::app()->mobileDetect->isMobile()) {
            $limitNewsList = 4;
        }
        $this->widget('application.widgets.news.NewsListWidget', array(
//            'item_class' => 'col-sm-12 col-md-12',
            'category_code' => 'news.sport',
            'itemView' => '/_views/_list_view_2',
            'headerText' => Yii::t('app', 'Sport'),
//            'show_description' => false,
            'count' => $limitNewsList,
        ));
        ?>
    </div>
    <div class="col-md-4">
        <?php
        $this->widget('application.widgets.news.NewsListWidget', array(
//            'item_class' => 'col-sm-12 col-md-12',
            'category_code' => 'news.business',
            'itemView' => '/_views/_list_view_2',
            'headerText' => Yii::t('app', 'Business'),
//            'show_description' => false,
            'count' => $limitNewsList,
        ));
        ?>
    </div>

    <div class="col-md-12 bg-base col-lg-12 col-xl-12 visible-xs">

        <div class="mobile-responsive visible-xs">
            <?php
            $this->widget('application.widgets.banners.BannersWidget', array(
                'type' => 'mobileBannerD',
                'outer_css_id' => 'mobileBannerD',
            ));
            ?>
        </div>
    </div>

    <div class="col-md-4">
        <?php
        $this->widget('application.widgets.news.NewsListWidget', array(
//            'item_class' => 'col-sm-12 col-md-12',
            'category_code' => 'news.world',
            'itemView' => '/_views/_list_view_2',
            'headerCssClass' => 'header_news_by_category',
            'headerText' => Yii::t('app', 'In the world'),
//            'show_description' => false,
            'count' => $limitNewsList,
        ));
        ?>
    </div>
    <?php
    $this->widget('application.widgets.banners.BannersWidget', array(
        'type' => 'bannerNesipetsin',
        'outer_css_class' => 'mobile-responsive visible-xs',
    ));
    ?>
</div>

<div class="row">
    <div class="col-md-12">
        <?php
        $this->widget('application.widgets.banners.BannersWidget', array(
            'type' => 'bannerG',
            'inner_css_style' => 'max-width:100%',
        ));
        ?>
    </div>
</div>


<div class="row mobile_block block">
    <div class="col-md-12 bg-base col-lg-12 col-xl-12">
        <?php
        $this->widget('application.widgets.category.CategoryHeaderWidget', array(
            'maxSubCatCount' => 5,
            'category_code' => 'compositions',
            'categoy_index_url' => '//compositions/index',
        ));
        ?>
    </div>

    <div class="col-md-12 bg-base col-lg-12 col-xl-12">
        <?php
        $this->widget('application.widgets.compositions.CompositionsWidget', array(
//            'columnCount' => 18,
            'item_class' => 'col-sm-2 col-md-2',
            'viewType' => 'tile',
            'parent_category_code' => 'compositions',
            'show_description' => false,
            'count' => 6,
        ));
        ?>
    </div>


    <div class="col-md-12">
        <div class="more-wrapper visible-xs">
            <?php echo CHtml::link(Yii::t('app', 'more'), Yii::app()->controller->categoryUrl, array('class' => 'more-link')); ?>
        </div>
    </div>
</div>


<div class="row mobile_block block">
    <div class="col-md-12 bg-base col-lg-12 col-xl-12">
        <?php
        $this->widget('application.widgets.category.CategoryHeaderWidget', array(
            'maxSubCatCount' => 5,
            'category_code' => 'billboard',
            'categoy_index_url' => '//catalog/category',
        ));
        ?>
    </div>

    <div class="col-md-12 bg-base">
        <?php
        $this->widget('application.widgets.afishas.AfishaIndexWidget', array(
            'category_code' => 'billboard',
        ));
        ?>
    </div>

    <!--    <div class="sidebar col-md-3 col-lg-3 col-xl-3 pull-right" style="text-align: right">-->
    <!--        --><?php
    //        $this->widget('BannersWidget', array(
    //            'type' => 'bannerE',
    //            'outer_css_class' => 'hidden-sm',
    //            'outer_css_id' => 'bannerE',
    //        ));
    //        ?>
    <!--    </div>-->
    <!--    <div class="more-wrapper visible-xs">-->
    <!--        <i class="fa fa-chevron-right"></i>-->
    <!--        --><?php //echo CHtml::link(Yii::t('app', 'more'), Yii::app()->controller->categoryUrl, array('class' => 'more-link')); ?>
    <!--    </div>-->
</div>

<div class="row">
    <div class="col-md-12">
        <?php
        $this->widget('application.widgets.banners.BannersWidget', array(
            'type' => 'indexAdsense1',
        ));
        ?>
    </div>
    <?php
    //     if(!Yii::app()->mobileDetect->isMobile()):
    ?>
    <div class="col-md-6">
        <?php
        //        $this->widget('application.widgets.banners.BannersWidget', array(
        //            'type' => 'indexAdsense2',
        //        ));
        ?>
    </div>
    <?php
    //        endif;
    ?>
</div>

<div class="row mobile_block block">
    <div class="col-md-12 bg-base col-lg-12 col-xl-12">

        <?php
        $this->widget('CategoryHeaderWidget', array(
            'maxSubCatCount' => 5,
            'category_code' => 'tenders',
        ));
        ?>
    </div>

    <div class="col-md-9 bg-base col-lg-9 col-xl-9">
        <div class="row">
            <div class="col-md-6">
                <?php
                $this->widget('application.widgets.catalog.CatalogListviewWidget2', array(
                    'count' => 6,
                    'page' => 1,
                    'parent_category_code' => 'tenders',
                    'show_sub_header' => false,
                    'item_class' => 'col-sm-12 col-md-12',
                    'show_photo' => false,
                    'show_all' => false,
                    'itemView' => '_simpleview',
                    'sortableAttributes' => array(),
                    'view' => 'CatalogListviewWidget_2_2',
                ));

                //                $this->widget('application.widgets.auto.AutoListviewWidget', array(
                //                    'count' => 6,
                //                    'show_photo' => true,
                //                    'item_class' => 'col-md-12',
                //                ));
                ?>
            </div>
            <?php if (!$this->isMobile()) { ?>
                <div class="col-md-6">
                    <?php
                    $this->widget('application.widgets.catalog.CatalogListviewWidget2', array(
                        'count' => 6,
                        'page' => 2,
                        'parent_category_code' => 'tenders',
                        'show_sub_header' => false,
                        'item_class' => 'col-sm-12 col-md-12',
                        'show_photo' => false,
                        'show_all' => false,
                        'itemView' => '_simpleview',
                        'sortableAttributes' => array(),
                        'view' => 'CatalogListviewWidget_2_2',
                    ));
                    ?>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="sidebar col-md-3 col-lg-3 col-xl-3 pull-right">
        <?php
        $this->widget('BannersWidget', array(
            'type' => 'bannerI',
            'outer_css_class' => 'colheight-sm-2 hidden-sm',
            'outer_css_id' => 'banner2',
        ));
        ?>
    </div>
    <div class="col-md-12">
        <div class="more-wrapper visible-xs">
            <?php echo CHtml::link(Yii::t('app', 'more'), Yii::app()->controller->categoryUrl, array('class' => 'more-link')); ?>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12 bg-base col-lg-12 col-xl-12">
        <div class="mobile-responsive visible-xs">
            <?php
            $this->widget('application.widgets.banners.BannersWidget', array(
                'type' => 'mobileBannerF',
                'outer_css_id' => 'mobileBannerF',
            ));
            ?>
        </div>
    </div>
</div>


<div class="row mobile_block block visible-xs">
    <div class="col-md-12 bg-base col-lg-12 col-xl-12">
        <div class="row category_header ">
            <div class="box_header_index">
                <div class="subHeader">
                    <span class="headerColor"><?php echo Yii::t('app', 'ad_header'); ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class=" col-md-3 col-lg-3 col-xl-3 hidden">
        <?php
        $this->widget('BannersWidget', array(
            'type' => 'bannerJ',
            'outer_css_class' => 'hidden-sm',
            'outer_css_id' => 'banner2',
        ));
        ?>
    </div>
    <div class="col-md-9 bg-base col-lg-9 col-xl-9 ">

        <div class="row">
            <?php
            if (!Yii::app()->mobileDetect->isMobile()) {
                ?>
                <div class="col-md-4 mixed-block">
                    <?php $this->widget('application.widgets.category.CategoryListWidget', array(
                        'count' => 5,
                        'parent_category_code' => 'advert',
                        'item_class' => 'col-md-6 col-xs-6',
                        'relatedActiveRecord' => 'Advert',
                    )); ?>
                </div>
                <?php
            } else {
                $this->widget('application.widgets.advert.AdvertListWidget', array(
//            'item_class' => 'col-sm-12 col-md-12',
                    'parent_category_code' => 'advert',
                    'itemView' => '_list_view_2',
                    'headerCssClass' => 'header_news_by_category',
                    'count' => 3,
                ));
            }
            ?>
            <?php
            if (!Yii::app()->mobileDetect->isMobile()):
                ?>
                <div class="col-md-2 mixed-block">
                    <?php
                    $this->widget('application.widgets.category.CategoryListWidget', array(
                        'count' => 5,
                        'parent_category_code' => 'estate',
                        'item_class' => 'col-md-12 col-xs-6',
                        'relatedActiveRecord' => 'Estates',
                    ));
                    ?>
                </div>
            <?php
            endif;
            ?>
            <?php
            if (!Yii::app()->mobileDetect->isMobile()) {
                ?>
                <div class="col-md-4 mixed-block">
                    <?php
                    $this->widget('application.widgets.category.CategoryListWidget', array(
                        'count' => 5,
                        'parent_category_code' => 'service',
                        'item_class' => 'col-md-6 col-xs-6',
                        'relatedActiveRecord' => 'Catalog',
                    ));
                    ?>
                </div>
                <?php
            } else { ?>
                <div class="col-md-12 bg-base col-lg-12 col-xl-12">
                    <div class="row category_header ">
                        <div class="box_header_index">
                            <div class="subHeader">
                                <span class="headerColor"><?php echo Yii::t('app', 'service_header'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                $this->widget('application.widgets.catalog.CatalogListWidget', array(
//            'item_class' => 'col-sm-12 col-md-12',
                    'parent_category_code' => 'service',
                    'itemView' => '_list_view_2',
//                    'headerCssClass' => 'header_news_by_category',
                    'count' => 3,
                ));
            }
            ?>
            <?php
            if (!Yii::app()->mobileDetect->isMobile()) {
                ?>
                <div class="col-md-2 mixed-block">
                    <?php
                    $this->widget('application.widgets.category.CategoryListWidget', array(
                        'count' => 5,
                        'parent_category_code' => 'work',
                        'item_class' => 'col-md-12 col-xs-6',
                        'relatedActiveRecord' => 'Work',
                    ));
                    ?>
                </div>
                <?php
            } else {
                ?>
                <div class="col-md-12 bg-base col-lg-12 col-xl-12">
                    <div class="row category_header ">
                        <div class="box_header_index">
                            <div class="subHeader">
                                <span class="headerColor"><?php echo Yii::t('app', 'work_header'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $this->widget('application.widgets.work.WorkListviewWidget', array(
                    'count' => 3,
                    'view' => '_view',
                ));
            }
            ?>
            <?php
            if (Yii::app()->mobileDetect->isMobile()):
                ?>
                <div class="col-md-2 mixed-block">
                    <?php
                    $this->widget('application.widgets.category.CategoryListWidget', array(
                        'count' => 5,
                        'parent_category_code' => 'estate',
                        'item_class' => 'col-md-12 col-xs-6',
                        'relatedActiveRecord' => 'Estates',
                    ));
                    ?>
                </div>
            <?php
            endif;
            ?>

        </div>
        <div class="row">
            <?php
            $this->widget('BannersWidget', array(
                'type' => 'baraholkaBottom',
                'outer_css_class' => 'hidden-sm',
                'outer_css_id' => 'baraholkaBottom',
            ));
            ?>
        </div>
    </div>

</div>


<?php
//$this->widget('application.widgets.carousel.multimedia.Carousel', array(
//    'view'=>'cart',
//    'widget_title'=>'Multimedia'
//));
?>


<div class="row mobile_block block">


    <div class="col-md-12 hidden-xs">
        <?php
        $this->widget('application.widgets.category.CategoryHeaderWidget', array(
            'maxSubCatCount' => 3,
            'category_code' => 'advert',
            'categoy_index_url' => '//blog',
            'override_main_title' => Yii::t('app', 'advert'),
            'view' => 'CategoryHeaderWidget_3',
        ));
        ?>
        <div class="row">
            <div class="col-md-4">
                <?php

                $this->widget('application.widgets.advert.AdvertListWidget', array(
                    'item_class' => ' ',
                    'parent_category_code' => 'advert',
                    'itemView' => '_list_view_2',
                    'headerCssClass' => 'header_news_by_category',
                    'count' => 6,
                ));
                ?>
            </div>
            <div class="col-md-4">
                <?php
                $this->widget('application.widgets.work.WorkListviewWidget', array(
                    'item_class' => ' ',
                    'count' => 6,
                    'view' => '_view',
                ));
                ?>
            </div>
            <div class="col-md-4">
                <?php
                $this->widget('application.widgets.catalog.CatalogListWidget', array(
                    'item_class' => 'col-xs-12',
                    'category_code' => 'service',
                    'itemView' => '_list_view_2',
//                    'headerCssClass' => 'header_news_by_category',
                    'count' => 6,
                ));
                ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php
        $this->widget('application.widgets.banners.BannersWidget', array(
            'type' => 'bannerL',
            'inner_css_style' => 'max-width:100%',
        ));
        ?>
    </div>
</div>


<div class="row mobile_block block">
    <div class="col-md-12 bg-base col-lg-12 col-xl-12">
        <?php
        $this->widget('CategoryHeaderWidget', array(
            'maxSubCatCount' => 5,
            'category_code' => 'photoreport',
        ));
        ?>
    </div>
    <div class="col-md-12 bg-base col-lg-12 col-xl-12">

        <?php
        $this->widget('application.widgets.photoreport.PhotoreportWidget', array(
            'settings' => array(
                array(
                    "thumbWidth" => 384,
                    "thumbHeight" => 435,
                    'cssClass' => "col-xs-6 col-sm-3 col-md-3 col-lg-3 colheight-sm-1 "
                ),
                array(
                    "thumbWidth" => 385,
                    "thumbHeight" => 435,
                    'cssClass' => "col-xs-6 col-sm-3 col-md-3 col-lg-3 colheight-sm-1 "
                ),
                array(
                    "thumbWidth" => 385,
                    "thumbHeight" => 435,
                    'cssClass' => "col-xs-6 col-sm-3 col-md-3 col-lg-3 colheight-sm-1 "
                ),
                array(
                    "thumbWidth" => 385,
                    "thumbHeight" => 435,
                    'cssClass' => "col-xs-6 col-sm-3 col-md-3 col-lg-3 colheight-sm-1 "
                ),
                array(
                    "thumbWidth" => 385,
                    "thumbHeight" => 435,
                    'cssClass' => "col-xs-6 col-sm-3 col-md-3 col-lg-3 colheight-sm-1 "
                ),
                array(
                    "thumbWidth" => 385,
                    "thumbHeight" => 435,
                    'cssClass' => "col-xs-6 col-sm-3 col-md-3 col-lg-3 colheight-sm-1 "
                ),
                array(
                    "thumbWidth" => 385,
                    "thumbHeight" => 435,
                    'cssClass' => "col-xs-6 col-sm-3 col-md-3 col-lg-3 colheight-sm-1 "
                ),
                array(
                    "thumbWidth" => 385,
                    "thumbHeight" => 435,
                    'cssClass' => "col-xs-6 col-sm-3 col-md-3 col-lg-3 colheight-sm-1 "
                ),
            ),
        ));
        ?>


    </div>
    <div class="col-md-12">
        <div class="more-wrapper visible-xs">
            <?php echo CHtml::link(Yii::t('app', 'more'), Yii::app()->controller->categoryUrl, array('class' => 'more-link')); ?>
        </div>
    </div>
</div>

<!---->
<!--<div class="row mobile_block block">-->
<!--    <div class="col-md-12 bg-base col-lg-12 col-xl-12">-->
<!--        --><?php
//        $this->widget('CategoryHeaderWidget', array(
//            'maxSubCatCount' => 5,
//            'category_code' => 'guide',
//        ));
//        ?>
<!--    </div>-->
<!---->
<!--    <div class="col-md-4" style="border-right: 0px solid #eee;">-->
<!--        --><?php
//        $this->widget('BannersWidget', array(
//            'type' => 'bannerK',
//            'outer_css_class' => 'hidden-sm',
//            'outer_css_id' => 'banner2',
//        ));
//        //        $this->widget('application.widgets.catalog.CatalogListviewWidget', array(
//        //            'count' => 6,
//        //            'parent_category_code' => 'business',
//        //            'show_sub_header' => true,
//        //            'item_class' => 'col-sm-12 col-md-12',
//        //            'show_photo' => false,
//        //            'show_all' => true,
//        //            'itemView' => '_simpleview',
//        //            'sortableAttributes' => array()
//        //        ));
//        ?>
<!--    </div>-->
<!---->
<!--    <div class="col-md-4" style="border-right: 0px solid #eee;">-->
<!--        --><?php
//        $this->widget('application.widgets.catalog.CatalogListviewWidget', array(
//            'count' => 4,
//            'parent_category_code' => 'tenders',
//            'show_sub_header' => true,
//            'item_class' => 'col-sm-12 col-md-12',
//            'show_photo' => false,
//            'show_all' => true,
//            'itemView' => '_simpleview',
//            'sortableAttributes' => array()
//        ));
//        ?>
<!--    </div>-->
<!---->
<!--    <div class="col-md-4">-->
<!--        --><?php
//        $this->widget('application.widgets.catalog.CatalogListviewWidget', array(
//            'count' => 4,
//            'parent_category_code' => 'guide',
//            'show_sub_header' => true,
//            'item_class' => 'col-sm-12 col-md-12',
//            'show_photo' => false,
//            'show_all' => true,
//            'itemView' => '_simpleview',
//            'sortableAttributes' => array()
//        ));
//        ?>
<!--    </div>-->
<!---->
<!--    <div class="row hidden-xs">-->
<!--        <div class="col-md-12">-->
<!--            --><?php
//            $this->widget('application.widgets.banners.BannersWidget', array(
//                'type' => 'bannerL',
//                'inner_css_style' => 'max-width:100%',
//            ));
//            ?>
<!--        </div>-->
<!--    </div>-->
<!--</div>-->


