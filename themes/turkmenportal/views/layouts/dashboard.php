<?php /* @var $this Controller */ ?>
<?php $themeUrl = Yii::app()->theme->baseUrl; ?>

<?php $this->beginContent('//layouts/column2_wrapper'); ?>

<?php if (!isset($this->breadcrumbs)) { ?>
    <?php
    if (Yii::app()->controller->route !== 'site/index')
        $this->breadcrumbs = array_merge(array(Yii::t('zii', 'Home') => Yii::app()->homeUrl), $this->breadcrumbs);

    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links' => $this->breadcrumbs,
        'homeLink' => false,
        'tagName' => 'ol',
        'separator' => '',
        'activeLinkTemplate' => '<li><a href="{url}">{label}</a> <span class="divider">/</span></li>',
        'inactiveLinkTemplate' => '<li><span>{label}</span></li>',
        'htmlOptions' => array('class' => 'breadcrumb ribbon-inner')
    )); ?>
<?php } ?>

<?php echo $content; ?>

<?php $this->endContent(); ?>

                
                