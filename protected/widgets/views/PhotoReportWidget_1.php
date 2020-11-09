<?php //require_once('tpl_banners.php') ?>


<?php
    $categoryModel = Category::model()->findByAttributes(array('code' => 'fotoreport'));
    $sub_categories = Category::model()->sort_by_sort_order()->with_parent()->findAllByAttributes(array('parent_id' => $categoryModel->id));
?>

<div class="row">
    <div class="box_header_index">
        <div class="header">
            <?php
            echo CHtml::link($categoryModel->getMixedDescriptionModel()->name, Yii::app()->createUrl('//catalog/category', array('category_id' => $categoryModel->id)), array('class' => "headerColor"));
//            echo '<span class="headerColor">'.$categoryModel->getMixedDescriptionModel()->name.'</span>';
            foreach ($sub_categories as $key => $category) {
                if ($key > 5)
                    continue;
                echo CHtml::link($category->getMixedDescriptionModel()->name, Yii::app()->createUrl('//catalog/category', array('category_id' => $category->id)), array("class" => "indexLink blueColor"));
            }
            ?>
        </div>
    </div>
</div>



<div class="row subnav-tabbed-panels" >
    <div id="tabAll" class="subnav-tabbed-panel">
        <?php
            $this->widget('bootstrap.widgets.BootListView', array(
                'dataProvider' => $dataProvider,
                'itemView' => '_listview_fotoreport',
                'summaryText' => '',
                'pagerCssClass' => "pagination",
                'pager' => array('header' => '',
                    'maxButtonCount' => $this->maxButtonCount,
                    'cssFile' => false,
                    'htmlOptions' => array('class' => 'pagination pull-right'),
                    'prevPageLabel' => '<i class="fa fa-chevron-left"></i>',
                    'nextPageLabel' => '<i class="fa fa-chevron-right"></i>',
                    'firstPageLabel' => Yii::t('app', '$LNG_FIRST'),
                    'lastPageLabel' => Yii::t('app', '$LNG_LAST'),
                ),
            ));
        ?>
    </div>
</div>


