<?php /* @var $this Controller */ ?>
<?php $themeUrl = Yii::app()->theme->baseUrl; ?>

<?php $this->beginContent('//layouts/column2_wrapper'); ?>

<div class="row mobile_block inned">
    <div class="col-md-8 bg-base col-lg-8 col-xl-9">

        <?php if (isset($this->breadcrumbs)) { ?>
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

                
                