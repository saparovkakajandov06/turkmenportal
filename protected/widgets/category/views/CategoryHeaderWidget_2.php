<!--noindex-->
<?php $this->beginWidget('DNofollowWidget'); ?>
<?php Yii::app()->controller->categoryUrl = $categoryModel->url; ?>

<?php
$title = $categoryModel->name;
if (isset($this->override_main_title) && strlen(trim($this->override_main_title)) > 2)
    $title = $this->override_main_title;
?>
<div class="header_news_by_category">
    <h1>
        <?=CHtml::link($title, $categoryModel->url, array ('class' => "headerColor")); ?>
    </h1>
    <a href="<?=$categoryModel->url?>" class="more"> <?=yii::t('app', 'more')?></a>
</div>

<?php $this->endWidget(); ?>
<!--/noindex-->