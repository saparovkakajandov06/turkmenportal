<?php
    $this->widget('bootstrap.widgets.BootListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => '_listview',
        'summaryText' => '',
        'pagerCssClass' => "pagination",
        'htmlOptions' => array('class' => 'row'),
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