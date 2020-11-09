<?php if(isset ($this->show_header) && $this->show_header==true) { ?>
    <div class="box_header_index">
        <span class="headerColor mini"><?php echo Yii::t('app', 'Compositions'); ?></span>
    </div>
<?php }?>


<?php
$this->widget('bootstrap.widgets.BootListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => "//list/".$this->itemView,
    'summaryText' => false,
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

<div class="clearfix"></div>
