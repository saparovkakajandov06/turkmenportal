<?php /* @var $this Controller */ ?>
<?php $themeUrl = Yii::app()->theme->baseUrl; ?>
<?php $this->beginContent('//layouts/main'); ?>

<!--<a target="_blank" class="wrapper-branding noajax" href="/api/outreach/go/744/69">-->
<!--    <picture>-->
<!--        <source media="(max-width: 1580px)" data-srcset="/design/images/new/branding/2020/744/1440x900.png"-->
<!--                srcset="https://101.ru/design/images/new/branding/2020/744/1440x900.png">-->
<!---->
<!--        <img data-src="/design/images/new/branding/2020/744/1920x1080.png" alt="Радио по настроению"-->
<!--             class="wrapper-branding__img lazyload" loading="lazy"-->
<!--             src="https://101.ru/design/images/new/branding/2020/744/1920x1080.png">-->
<!--    </picture>-->
<!--</a>-->

<?php
$this->widget('application.widgets.banners.BannersWidget', array(
    'type' => 'bannerBranding',
    'outer_css_class' => 'wrapper-branding',
//    'outer_css_style' => 'position: fixed;',
));
?>


<div id="main" class="">
    <?php require_once('frontend/tbl_banners.php') ?>

    <div id="content" class="content section container">
        <?php echo $content; ?>
        <?php $this->renderPartial('//layouts/frontend/tpl_footer', array()); ?>
    </div>

    <?php Yii::beginProfile('headerId'); ?>
    <?php require_once('frontend/tpl_header.php') ?>
    <?php Yii::endProfile('headerId'); ?>
</div>


<?php $this->endContent(); ?>

                
                