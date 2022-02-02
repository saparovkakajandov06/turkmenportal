<?php
Yii::app()->clientScript->registerScript('yandex_script', '
            (function (d, w, c) {
                (w[c] = w[c] || []).push(function() {
                    try {
                        w.yaCounter24581507 = new Ya.Metrika({id:24581507,
                                webvisor:true,
                                clickmap:true,
                                trackLinks:true,
                                accurateTrackBounce:true});
                    } catch(e) { }
                });

                var n = d.getElementsByTagName("script")[0],
                    s = d.createElement("script"),
                    f = function () { n.parentNode.insertBefore(s, n); };
                s.type = "text/javascript";
                s.async = true;
                s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

                if (w.opera == "[object Opera]") {
                    d.addEventListener("DOMContentLoaded", f, false);
                } else { f(); }
            })(document, window, "yandex_metrika_callbacks");
            
                 (function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,\'script\',\'//www.google-analytics.com/analytics.js\',\'ga\');

            ga(\'create\', \'UA-59198947-1\', \'auto\');
            ga(\'send\', \'pageview\');


        ', CClientScript::POS_END);
//
//
//        Yii::app()->clientScript->registerScript('google_script', "
//            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
//            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
//            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
//            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
//
//            ga('create', 'UA-59198947-1', 'auto');
//            ga('send', 'pageview');
//
//        ", CClientScript::POS_END);
$themeUrl = Yii::app()->theme->baseUrl;
?>


<div id="header_wrapper">

    <div class="container">

        <div class="row">
            <div class="hidden-xs">
                <?php
                $this->widget('application.widgets.banners.BannersWidget', array(
                    'type' => 'bannerA',
                    'outer_css_id' => 'banner-header',
                ));
                ?>
            </div>
        </div>

        <div class="row sub_header_panel">
            <div class="col-md-9 hidden-xs header_links">
                <span id="date_time">2014</span>
                <?php
                $this->widget('application.widgets.weather.WeatherWidget', array(
                ));
                ?>
                <?php echo ' | ' . CHtml::link(Yii::t('app', 'valyutas'), "http://www.cbt.tm/kurs/kurs_today.html", array('target' => "_blank", 'rel' => 'nofollow')); ?>
                <?php echo ' | ' . CHtml::link(Yii::t('app', 'bankomat_lists'), "http://www.cbt.tm/tm/payment/bankomat_as.html?Ashgabat", array('target' => "_blank", 'rel' => 'nofollow')); ?>
                <?php echo ' | ' . CHtml::link('18+', '#', ['class' => 'none-link']); ?>
            </div>
            <div class="col-xs-6 visible-xs">
                <?php
                $this->widget('application.widgets.weather.WeatherWidget', array(
                        'view' => 'weatherMobile',
                ));
                ?>
                <a href="<?php echo Yii::app()->createAbsoluteUrl('/site/index'); ?>" class="mobile_logo"><img
                        src="<?php echo $themeUrl; ?>/img/mobile_logo_2.png"></a>
            </div>
            <div class="col-md-3 col-xs-6 pull-right">
                <div class="langPanel">
                    <div class="social-icons clearfix">
                        <div class="" style="text-align:right; display: inline-block;">
                            <span class="lang_select_text"><?php echo Yii::t('app', 'select_language:'); ?></span>
                            <?php $this->widget('LanguageSwitcherWidget'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row sub_header_middle_panel">
            <div class="col-md-4" style="padding:0px; padding-left: 0px;">
                <div class="logoPanel hidden-xs">
                    <a href="<?php echo Yii::app()->createAbsoluteUrl('/site/index'); ?>"><img class="img-responsive"
                                src="<?php echo $themeUrl; ?>/img/logo_tp.png?v=1"></a>
                </div>

            </div>

            <div class="col-md-8 hidden-xs">
                <?php
                $this->widget('application.widgets.banners.BannersWidget', array(
                    'type' => 'bannerB',
                    'outer_css_id' => 'banner1',
                ));
                ?>
            </div>
        </div>
        <?php require_once('tpl_navigation.php'); ?>

    </div>


</div>

    
    



