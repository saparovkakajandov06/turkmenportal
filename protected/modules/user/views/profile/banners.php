<?php $this->pageTitle = Yii::app()->name . ' - ' . Yii::t('app', "My banners");
$this->breadcrumbs = array(
    UserModule::t("Profile") => array('profile'),
    UserModule::t("Edit"),
);

$this->menu = array(
    array('label' => UserModule::t('Profile'), 'url' => array('/user/profile')),
    array('label' => UserModule::t('Edit'), 'url' => array('/user/profile/edit')),
    array('label' => UserModule::t('Change password'), 'url' => array('/user/profile/changepassword')),
    array('label' => UserModule::t('Logout'), 'url' => array('/user/logout')),
);
?><h1><?php echo Yii::t('app', 'My banners'); ?></h1>

<?php if (Yii::app()->user->hasFlash('profileMessage')): ?>
    <div class="success">
        <?php echo Yii::app()->user->getFlash('profileMessage'); ?>
    </div>
<?php endif; ?>

<div style="overflow: auto">
    <?php

    $this->widget('bootstrap.widgets.BootGridView', array(
        'id' => 'banner-grid',
        'type' => 'striped bordered condensed',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'summaryText' => false,
        'pagerCssClass' => "pagination",
        'pager' => array('header' => '',
            //'maxButtonCount' => $this->maxButtonCount,
            'cssFile' => false,
            'htmlOptions' => array('class' => 'pagination pull-right'),
            'prevPageLabel' => '<i class="fa fa-chevron-left"></i>',
            'nextPageLabel' => '<i class="fa fa-chevron-right"></i>',
            'firstPageLabel' => Yii::t('app', '$LNG_FIRST'),
            'lastPageLabel' => Yii::t('app', '$LNG_LAST'),
        ),
        'columns' => array(
            array(
                'name' => 'thumb',
                'value' => '$data->getThumbPath(25,25)',
                'type' => 'image',
            ),
            array(
                'name' => 'bannerType',
                'value' => '$data->getBannerTypeText()',
                'type' => 'raw',
            ),
            'description',
            array(
                'name' => 'format_type',
                'value' => '$data->getFormatTypeText()',
                'type' => 'raw',
            ),
            array(
                'name' => 'dimensions',
                'value' => '$data->getDimensionsText()',
                'type' => 'raw',
            ),
            array(
                'name' => 'view_count',
                'value' => '$data->view_count',
                'type' => 'raw',
            ),
            array(
                'name' => 'click_count',
                'value' => '$data->click_count',
                'type' => 'raw',
            ),
            'date_added',
            'date_expire',
            array(
                'name' => 'status',
                'value' => '$data->getStatusText()',
                'type' => 'raw',
            ),
//        'adsense_code',
//        array(
//            'class' => 'bootstrap.widgets.BootButtonColumn',
//            'htmlOptions' => array('style' => 'width: 85px; text-align:right;'),
//        ),
        ),
    )); ?>
</div>
