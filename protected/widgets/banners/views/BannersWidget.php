<!--noindex-->
<?php $this->beginWidget('DNofollowWidget'); ?>
<div class="<?= $this->type ?> banner_wrapper" style="<?= $this->outer_css_style ?>">
    <?php
    if ($this->ajax == true) {
        echo '<div id="banner_wrapper' . $this->outer_css_id . '"></div>';
        Yii::app()->clientScript->registerScript("bannerWidgetWrapper",
            'function bannerWidget(){' .
            CHtml::ajax(
                array(
                    'url' => array("//widgets/partial"),
                    'dataType' => 'html',
                    'type' => 'POST',
                    'update' => '#banner_wrapper' . $this->outer_css_id,
                    'data' => array(
                        "widget" => 'application.widgets.banners.BannersWidget',
                        'type' => $this->type,
                        'outer_css_class' => $this->outer_css_class,
                        'outer_css_id' => $this->outer_css_id,
                    )
                )
            ) . ' 
            }
                
            timer = setTimeout("bannerWidget()", 1000);',
            CClientScript::POS_END);
    } else {
        switch ($bannerTypeModel->type) {
            case BannerType::TYPE_FLASH:
                $this->render('flash', array('bannerModel' => $bannerModel));
                break;
            case BannerType::TYPE_ADSENSE:
                $this->render('adsense', array('bannerModel' => $bannerModel));
                break;
            case BannerType::TYPE_IMAGE:
                $this->render('image', array('bannerModel' => $bannerModel));
                break;
            case BannerType::TYPE_IMAGE_RANDOM:
                $this->render('image', array('bannerModel' => $bannerModel));
                break;
            case BannerType::TYPE_IMAGE_SLIDER:
                $this->render('slider', array('banners' => $banners, 'bannerTypeModel' => $bannerTypeModel));
                break;
        }
    } ?>
</div>
<?php $this->endWidget(); ?>
<!--/noindex-->
