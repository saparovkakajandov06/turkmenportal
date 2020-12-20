<?php
    $this->widget('bootstrap.widgets.BootListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => $this->view,
        'summaryText' => '',
        'pagerCssClass' => "pagination",
        'htmlOptions' => array('class' => ''),
        'pager' => array('header' => '',
            'maxButtonCount' => $this->count,
            'cssFile' => false,
            'htmlOptions' => array('class' => 'pagination pull-right'),
            'prevPageLabel' => '<i class="fa fa-chevron-left"></i>',
            'nextPageLabel' => '<i class="fa fa-chevron-right"></i>',
            'firstPageLabel' => Yii::t('app', '$LNG_FIRST'),
            'lastPageLabel' => Yii::t('app', '$LNG_LAST'),
        ),
    ));
?>

<?php
if ($this->view === '_view'):
    ?>
    <div class="more-wrapper visible-xs" style="margin-bottom: 20px; ">
        <?php
        $this->widget('application.widgets.category.CategoryMoreWidget', array(
//            'maxSubCatCount' => 5,
            'category_code' => 'work',
            'categoy_index_url' => '//blog',
            'view' => 'CategoryMoreWidget',
        ));
        ?>
    </div>

<?php
endif;
?>

