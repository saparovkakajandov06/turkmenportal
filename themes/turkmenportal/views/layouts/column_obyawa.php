<?php /* @var $this Controller */ ?>
<?php $themeUrl = Yii::app()->theme->baseUrl; ?>

<?php $this->beginContent('//layouts/main'); ?>

<div id="main" class="container">
    <div id="content" class="content section ">
        <div class="row mobile_block">
            <div class="sidebar col-md-3 col-lg-3 col-xl-3" style="padding: 0px; padding-left: 20px;">
                <?php //require_once('frontend/tpl_col2r_sidebar.php')?>
                <div class="profile_setting">
                    <?php
                    $this->widget('zii.widgets.CMenu', array(
                        'items'=>$this->menu,
                        'htmlOptions'=>array('class'=>'operations'),
                    ));
                    ?>

                    <ul>
                        <li><?php echo CHtml::link(Yii::t('app','my_comments'),Yii::app()->createUrl('/user/profile/comments')); ?></li>
                        <li><?php echo CHtml::link(Yii::t('app','My publications'),Yii::app()->createUrl('/user/announcement')); ?></li>
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
    </div>
    <div class="row" >
        <?php require_once('frontend/tpl_footer.php') ?>
    </div>
</div>

<?php Yii::beginProfile('headerId'); ?>
<?php require_once('frontend/tpl_header.php') ?>
<?php Yii::endProfile('headerId'); ?>

<?php $this->endContent(); ?>

                
                