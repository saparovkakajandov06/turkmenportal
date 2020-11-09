<?php /* @var $this Controller */ ?>
<?php $themeUrl = Yii::app()->theme->baseUrl; ?>

<?php $this->beginContent('//layouts/column2_wrapper'); ?>


<div class="row mobile_block">
    <div class="sidebar col-md-3 col-lg-3 col-xl-3" style="padding: 0px; padding-left: 20px;">
        <?php //require_once('frontend/tpl_col2r_sidebar.php')?>
        <div class="profile_setting">
            <?php
            $this->widget('zii.widgets.CMenu', array(
                'items' => $this->menu,
                'htmlOptions' => array('class' => 'operations'),
            ));
            ?>

            <ul>
                <li><?php echo CHtml::link(Yii::t('app', 'my_comments'), Yii::app()->createUrl('/user/profile/comments')); ?></li>
                <li><?php echo CHtml::link(Yii::t('app', 'My publications'), Yii::app()->createUrl('/user/announcement')); ?></li>
                <?php if (Yii::app()->user->checkAccess('User.Profile.Banners')) { ?>
                    <li><?php echo CHtml::link(Yii::t('app', 'My banners'), Yii::app()->createUrl('/user/profile/banners')); ?></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="col-md-9 col-lg-9 col-xl-9 border-left ">
        <?php if (!isset($this->breadcrumbs)) { ?>
            <?php
            if (Yii::app()->controller->route !== 'site/index')
                $this->breadcrumbs = array_merge(array(Yii::t('zii', 'Home') => Yii::app()->homeUrl), $this->breadcrumbs);

            $this->widget('zii.widgets.CBreadcrumbs', array(
                'links' => $this->breadcrumbs,
                'homeLink' => false,
                'tagName' => 'ol',
                'separator' => '',
                'activeLinkTemplate' => '<li><a href="{url}">{label}</a> </li>',
                'inactiveLinkTemplate' => '<li><span>{label}</span></li>',
                'htmlOptions' => array('class' => 'row breadcrumb')
            )); ?>
        <?php } ?>

        <?php echo $content; ?>
    </div>


</div>

<?php $this->endContent(); ?>

                
                