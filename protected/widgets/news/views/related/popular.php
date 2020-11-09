<?php
$this->widget('bootstrap.widgets.BootListView', array(
    'dataProvider' => $dataProvider,
    //    'viewData' => $this->item_class,
    'itemView' => '/related/_related_news_mobile',
    'summaryText' => '',
    'emptyText' => '',
    'htmlOptions' => array('class' => 'row1'),
));
?>

