<!--noindex-->
<?php $this->beginWidget('DNofollowWidget'); ?>
<?php Yii::app()->controller->categoryUrl = $categoryModel->url; ?>

<?php
$title = $categoryModel->name;
if (isset($this->override_main_title) && strlen(trim($this->override_main_title)) > 2)
    $title = $this->override_main_title;
?>
<div class="header_news_by_category header_news_by_category_2">
    <h1>
        <?=CHtml::link($title, $categoryModel->url, array ('class' => "headerColor")); ?>
    </h1>
    <div class="sub_header">
        <?php
        if (!Yii::app()->mobileDetect->isMobile() && !Yii::app()->mobileDetect->isTablet() && !Yii::app()->mobileDetect->isIphone()) {
            $categories[] = Yii::app()->controller->categoryLink('work');
            $categories[] = Yii::app()->controller->categoryLink('service');
            $categories[] = Yii::app()->controller->categoryLink('estate');
                foreach ($categories as $category)
                echo CHtml::link($category->name, $category->url, array ("class" => "indexLink blueColor"));
        }
        ?>
    </div>
    <a href="<?=$categoryModel->url?>" class="more"> <?=yii::t('app', 'more')?></a>
</div>

<?php $this->endWidget(); ?>
<!--/noindex-->