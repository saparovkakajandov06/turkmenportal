<!DOCTYPE html>
<html class="no-js" lang="<?= Yii::app()->language ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="yandex-verification" content="87ae707381ab5a85"/>
    <meta name="yandex-verification" content="58893c1befeb2289"/>
    <meta name="pmail-verification" content="011ff5951f226e87a7d3ea4d163a334c">
    <?php
    $title = Yii::t('app', 'site_name');
    if (isset($this->pageTitle))
        $title = $this->pageTitle;
    ?>

    <title><?= $title ?></title>
    <?php
    if (!isset($this->meta_description) || strlen(trim($this->meta_description)) < 4)
        $this->meta_description = $title;

    if (isset($this->meta_description)) {
        $this->meta_description = str_replace('"', "", $this->meta_description);
        $this->meta_description = str_replace("'", "", $this->meta_description);
    }

    if (isset($this->meta_keyword) && strlen(trim($this->meta_keyword)) > 4) {
        $this->meta_keyword = str_replace('"', "", $this->meta_keyword);
        $this->meta_keyword = str_replace("'", "", $this->meta_keyword);
    } else {
        if (Yii::app()->language == 'ru') {
            $this->meta_keyword = "Turkmenistan news,новости Туркменистана, новости Туркмении,туркменский,Туркменистан,Туркмения,туркменистанцы, Ашхабад,ашхабадский,законы Туркменистана,банки ТУркменистана, справочник Туркменистана,Афиша Ашхабада, Магазины Ашхабада, Работа в Ашхабаде,Работа в Туркменистане,Авто Объявления,Недвижмость Туркменистана,Тендеры Туркменистана, Заведения Туркменистана, Услуги Туркменистана,Туризм в Туркменистане,Образование в Туркменистане,Бизнес справочник Туркменистана,Спорт Туркменистана,Партнерство в Туркменистане, Публикации о Туркменистане,Туркменбаши,Лебап,Мары,Ташауз,Балканабат,Аваза,Каспий,экономика Туркменистана,культура Туркменистана";
        }
    }
    $themeUrl = Yii::app()->theme->baseUrl;


    ?>
    <meta name="description" content="<?php echo $this->meta_description; ?>"/>
    <meta name="keywords" content="<?php echo $this->meta_keyword; ?>"/>
    <meta name="robots" content="index,follow"/>
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#a71f1f">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#a71f1f">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#a71f1f">

    <meta name="author" content="turkmenportal"/>
    <link rel="shortcut icon" href="<?php echo Yii::app()->baseUrl; ?>/img/favicon.ico" type="image/x-icon"/>
    <meta name="viewport" content="width = device-width, initial-scale = 1.0">
    <meta name="apple-mobile-web-app-capable" content="yes"/>

    <meta property="og:site_name" content="<?= Yii::t('app', 'site_name') ?>">
    <meta property="og:title" content="<?= $title ?>"/>
    <meta property="og:description" content="<?php echo $this->meta_description; ?>"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="<?php echo $this->page_url; ?>"/>
    <meta property="og:image" itemprop="image" content="<?php echo $this->page_image; ?>"/>
    <link rel="image_src" href="<?php echo $this->page_image; ?>">
    <script src="https://yastatic.net/pcode/adfox/loader.js" crossorigin="anonymous"></script>

    <?php
    $orphus = 'orphus_ru.js';
    if (Yii::app()->language == 'tm')
        $orphus = 'orphus_tm.js';

    Yii::app()->clientscript
        ->registerCssFile(Yii::app()->theme->baseUrl . '/css/bootstrap/bootstrap.min.css')
//        ->registerCssFile(Yii::app()->theme->baseUrl . '/css/countdown/jquery.countdown.min.css?v=0.1')
//        ->registerCssFile(Yii::app()->theme->baseUrl . '/css/fancybox/jquery.fancybox.min.css?v=0.1')
//                ->registerCssFile(Yii::app()->theme->baseUrl . '/css/form.css')
        ->registerCssFile(Yii::app()->theme->baseUrl . '/css/frontend/base.css?v=3.26')
        ->registerCssFile(Yii::app()->theme->baseUrl . '/css/frontend/components.min.css?v=0.27')

        ->registerCssFile(Yii::app()->theme->baseUrl . '/css/frontend/default.css?v=3.45')

//                ->registerCssFile(Yii::app()->theme->baseUrl . '/css/prettyPhoto/prettyPhoto.css')
//                ->registerCoreScript(Yii::app()->theme->baseUrl . '/js/jquery_1.8.3.js')
        ->registerCoreScript('jquery')
//                ->registerCoreScript('http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js')
//                ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jquery_1.8.3.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap/bootstrap.min.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/lazyload.min.js', CClientScript::POS_END)
//        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/fancybox/jquery.fancybox.min.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/main.js?v=1.17', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/social.min.js?v=0.11', CClientScript::POS_END)
//        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/orphus/' . $orphus, CClientScript::POS_HEAD)
//        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jssor/jssor.slider.js', CClientScript::POS_END)
//        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jssor/jssor.photoswipe.settings.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jssor/jssor.slider.mini.js', CClientScript::POS_END)
//                ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jssor/jssor.slider.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/assets/jquery.plugin.min.js?v=0.11', CClientScript::POS_END)
//        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/assets/jquery.countdown.min.js', CClientScript::POS_END)
//                ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/assets/jquery.yiigridview_manual.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/assets/jquery.yiilistview_manual.min.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/assets/jquery.ba-bbq_manual.min.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/assets/jquery.yiiactiveform.min.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/assets/jquery.yii.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/assets/jquery.history.min.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/assets/postscribe.min.js', CClientScript::POS_END);


    $themeUrl = Yii::app()->theme->baseUrl;
    Yii::app()->clientScript->registerScript('scripts', "
                    $('body').on('click','#ajax_register',function(){
                        var url=$(this).attr('href');
                        $.ajax({
                            'dataType':'html',
                            'success':function(data){
                                $('#nav-popup-inner .login_wrapper').hide();
                                postscribe('#nav-popup-inner', data);
                                $('.nav-popup').addClass('opened');   
                                $('.nav-popup').slideDown(500);   
                            },
                            'url':url,
                            'cache':false
                        });
                        return false;
                    });
                        
           ", CClientScript::POS_END);


    if (Yii::app()->language == 'ru') {
        Yii::app()->clientScript->registerScript('scripts_ready', "
                        date_time_ru('date_time');
                        aziadaCountDown('ru');
          ", CClientScript::POS_READY);
    }

    if (Yii::app()->language == 'tm') {
        Yii::app()->clientScript->registerScript('scripts_ready', "
                        date_time_tm('date_time');
                        aziadaCountDown('tm');
          ", CClientScript::POS_READY);
    }


    Yii::app()->clientScript->registerScript('lazy', "
        (function () {
        function logElementEvent(eventName, element) {
          console.log(Date.now(), eventName, element.getAttribute(\"src\"));
        }

        var callback_enter = function (element) {
          logElementEvent(\"🔑 ENTERED\", element);
        };
        var callback_exit = function (element) {
          logElementEvent(\"🚪 EXITED\", element);
        };
        var callback_loading = function (element) {
          logElementEvent(\"⌚ LOADING\", element);
        };
        var callback_loaded = function (element) {
          logElementEvent(\"👍 LOADED\", element);
        };
        var callback_error = function (element) {
          logElementEvent(\"💀 ERROR\", element);
          element.src = \"https://via.placeholder.com/440x560/?text=Error+Placeholder\";
        };
        var callback_finish = function () {
          logElementEvent(\"✔️ FINISHED\", document.documentElement);
        };
        var callback_cancel = function (element) {
          logElementEvent(\"🔥 CANCEL\", element);
        };

        var ll = new LazyLoad({
          class_applied: \"lz-applied\",
          class_loading: \"lz-loading\",
          class_loaded: \"lz-loaded\",
          class_error: \"lz-error\",
          class_entered: \"lz-entered\",
          class_exited: \"lz-exited\",
          // Assign the callbacks defined above
          callback_enter: callback_enter,
          callback_exit: callback_exit,
          callback_cancel: callback_cancel,
          callback_loading: callback_loading,
          callback_loaded: callback_loaded,
          callback_error: callback_error,
          callback_finish: callback_finish
        });
      })();
                   
           ", CClientScript::POS_END);


    ?>

    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-3053278953457124",
            enable_page_level_ads: true
        });
    </script>

    <script type="text/javascript" id="cookieinfo"
            src="//cookieinfoscript.com/js/cookieinfo.min.js"
            data-bg="#645862"
            data-fg="#FFFFFF"
            data-link="#F1D600"
            data-cookie="CookieInfoScript"
            data-text-align="left"
            data-message="<?= Yii::t('app', 'cookie_message') ?>"
            data-linkmsg="<?= Yii::t('app', 'cookie_link_more') ?>"
            data-close-text="OK">
    </script>
</head>

<?php
$class = '';
if (Yii::app()->mobileDetect->isMobile())
    $class = " mobilescreen ";
?>

<body class="<?php echo $class; ?>">
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WQZWGNT"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

<div id="bootstrap_dialog_wrapper"></div>
<div id="backtotop">
    <a href="#top" id="topOfPage" title="вверх" style="display: none;">
    </a>
</div>

<?php YiiBase::beginProfile('mainId2'); ?>
<?php echo $content; ?>
<?php YiiBase::endProfile('mainId2'); ?>

<noscript>
    <div><img src="//mc.yandex.ru/watch/24581507" style="position:absolute; left:-9999px;" alt=""/></div>
</noscript>

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/postscribe/2.0.8/postscribe.min.js"></script>-->
<script type="text/javascript" src="<?= Yii::app()->theme->baseUrl ?>/js/assets/jquery_1.8.3.js"></script>
<script type="text/javascript" src="<?= Yii::app()->theme->baseUrl ?>/js/assets/jquery-ui.min.loc.js"></script>
<!--        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
<div class="photoswipe_wrapper"></div>
<!-- Запрос на восстановление регистрационной информации -->

</body>
</html>