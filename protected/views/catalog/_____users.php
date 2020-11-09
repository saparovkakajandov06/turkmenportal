 
<h3><?php echo Yii::t('app','comments') ?></h3>

<?php
 
$this->widget('bootstrap.widgets.BootGridView', array(
    'id' => 'comments-grid',
    'type' => 'striped bordered condensed',
    'dataProvider' => $commentsModel->searchForUsers(),
    'htmlOptions' => array('class' => 'table-tp'),
    'summaryText' =>false,
    'pagerCssClass' => "pagination",
    'pager' => array('header' => '',
//                    'maxButtonCount' => $this->maxButtonCount,
        'cssFile' => false,
        'htmlOptions' => array('class' => 'pagination pull-right'),
        'prevPageLabel' => '<i class="fa fa-chevron-left"></i>',
        'nextPageLabel' => '<i class="fa fa-chevron-right"></i>',
        'firstPageLabel' => Yii::t('app', '$LNG_FIRST'),
        'lastPageLabel' => Yii::t('app', '$LNG_LAST'),
    ),
    'columns' => array(
        'text',
        'like_count',
        'dislike_count',
        'date_added',
    ),
));
?>