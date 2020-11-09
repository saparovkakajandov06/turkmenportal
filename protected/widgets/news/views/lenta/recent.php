<?php
$this->widget('bootstrap.widgets.BootListView', array(
    'dataProvider' => $dataProvider,
    //    'viewData' => $this->item_class,
    'itemView' => '/lenta/_lenta_news',
    'summaryText' => '',
    'emptyText' => '',
    'htmlOptions' => array('class' => 'row'),
));
?>

