<?php
$this->pageTitle = Yii::app()->name . ' | '.Yii::t('app', 'error_404');
$this->breadcrumbs = array(
    Yii::t('app', 'error_404')
);
?>
<div class="col-md-12">
    <h2 class="error_404"> <?php echo Yii::t('app', 'error_404'); ?></h2>

    <div class="error_404_content">
        <h5><?php echo Yii::t('app', 'error_404'); ?></h5>
        <p><?php echo Yii::t('app', 'error_404_you_can_search'); ?></p>

        <div class="searchPanel2">
            <div class="row">

                <?php echo CHtml::beginForm(Yii::app()->createUrl('//search/search'), 'get'); ?>
                <div class="col-md-12">
                    <?php echo CHtml::textField('query', '', array('placeholder' => Yii::t('app', 'tp_search_placeholder'))); ?>
                    <?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
                </div>
                <?php echo CHtml::endForm(); ?>
            </div>
        </div>
    </div>
</div>