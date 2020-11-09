<div id="related-news-wrapper">
    <div class="comments__head"><?php echo Yii::t('app', 'Read also'); ?></div>

    <?php
    if (Yii::app()->controller->isMobile()) {
        $tabs = array();
        $tabs[] = array('id' => 'related', 'label' => Yii::t('app', 'Related news'), 'content' => $this->render('/related/related', array('dataProvider' => $relatedDataProvider), true, false), 'active' => true);
        $tabs[] = array('id' => 'popular', 'label' => Yii::t('app', 'Trend news'), 'content' => $this->render('/related/popular', array('dataProvider' => $popularDataProvider), true, false));
        $tabs[] = array('id' => 'recent', 'label' => Yii::t('app', 'Lenta News'), 'content' => $this->render('/related/recent', array('dataProvider' => $recentDataProvider), true, false));

        $this->widget('bootstrap.widgets.TbTabs', array(
            "id" => "news-list-tabs",
            "type" => "tabs",
            'tabs' => $tabs
        ));
        ?>


        <div class="row">
            <div class="col-xs-12">
                <?php
                $this->widget('application.widgets.banners.BannersWidget', array(
                    'type' => 'bannerLevel3Related',
                    'outer_css_class' => '',
                    'outer_css_id' => 'bannerLevel3Related',
                ));
                ?>
            </div>
        </div>
    <?php } else { ?>
        <div class="row">
            <?php
            //            Yii::app()->controller->adsense_listview_index = rand(1, 5);
            $this->widget('bootstrap.widgets.BootListView', array(
                'dataProvider' => $relatedDataProvider,
                'itemView' => '/related/_related_news_desktop',
                'summaryText' => '',
                'emptyText' => '',
            ));
            ?>
        </div>
    <?php } ?>

</div>

