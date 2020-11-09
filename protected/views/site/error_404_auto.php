<?php
$this->pageTitle = Yii::app()->name . ' | ' . Yii::t('app', 'error_404');
$this->breadcrumbs = array(
    Yii::t('app', 'error_404')
);
?>
<div class="row">
    <div class="col-md-12">
        <h2 class="error_404"> <?php echo Yii::t('app', 'error_404'); ?></h2>
        <h4 style="color: #f11;"><?php echo Yii::t('app', 'error_404_auto'); ?></h4>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="comments__head"><?php echo Yii::t('app', 'error_404_auto_similar_ads'); ?></div>
    </div>
    <?php
    $searchModel = new Auto();
    $searchModel->unsetAttributes();
    $this->widget('bootstrap.widgets.BootListView', array(
        'dataProvider' => $searchModel->searchForCategory(null, 12, false),
        'itemView' => '/auto/_related_listview',
        'summaryText' => '',
        'emptyText' => '',
    ));
    ?>
</div>
