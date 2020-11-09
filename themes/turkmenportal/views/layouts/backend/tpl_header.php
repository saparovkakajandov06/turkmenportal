<h1 class="sr-only">Summarize</h1>

<?php
$_SESSION['KCFINDER']['disabled'] = false; // enables the file browser in the admin
$_SESSION['KCFINDER']['uploadURL'] = Yii::app()->baseUrl . "/images/uploads/"; // URL for the uploads folder
$_SESSION['KCFINDER']['uploadDir'] = Yii::app()->basePath . "/../images/uploads/"; // path to the uploads

Yii::app()->clientscript
    ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/assets/jquery.yii.min.js', CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/assets/jquery-ui.min.loc.js', CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/assets/rights.min.js', CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/assets/jquery.bgiframe.min.js', CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/assets/jquery.ajaxqueue.min.js', CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/assets/jquery.autocomplete.min.js', CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/assets/jquery-ui-timepicker-addon.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScript('scripts', "
                   function openKCFinder_singleFile(field) {
                        window.KCFinder = {};
                        window.KCFinder.callBack = function(url) {
                            $('#'+field).val(url);
                            window.KCFinder = null;
                        };

                        window.open('" . Yii::app()->baseUrl . '/kcfinder/browse.php?type=images' . "', 'kcfinder_single');
                    }");
?>


<nav id="header" class="header-navbar admin" role="navigation">
    <div class="header-navbar-inner container admin">
        <ul class="nav navbar-nav">
            <li class="pull-left " style="overflow: hidden;">
                <a href="<?php echo Yii::app()->baseUrl; ?>">
                    <div class="logo">Admin Panel</div>
                </a>
            </li>
            <li class="social-icons pull-right clearfix">
                <div class="" style="text-align:right;">
                    <?php $this->widget('LanguageSwitcherWidget'); ?>
            </li>
        </ul>

    </div>

</nav>