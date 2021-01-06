<!--noindex-->
<?php $this->beginWidget('DNofollowWidget'); ?>
<?php Yii::app()->controller->categoryUrl = $categoryModel->url; ?>

<div class="row category_header <?php echo $this->cssClass; ?>">
    <div class="box_header_index">
        <div class="header">
            <?php
            $title = $categoryModel->name;
            if (isset($this->override_main_title) && strlen(trim($this->override_main_title)) > 2)
                $title = $this->override_main_title;
            
            echo CHtml::link($title, $categoryModel->url, array ('class' => "headerColor")); ?>
        </div>

        <div class="sub_header">
            <?php
            if (!Yii::app()->mobileDetect->isMobile() && !Yii::app()->mobileDetect->isTablet() && !Yii::app()->mobileDetect->isIphone()) {
                foreach ($sub_categories as $key => $category) {
                    if ($key > $this->maxSubCatCount)
                        continue;
                    echo CHtml::link($category->name, $category->url, array ("class" => "indexLink blueColor"));
                }
            }
            ?>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>
<!--/noindex-->