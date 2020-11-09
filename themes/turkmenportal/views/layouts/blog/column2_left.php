<?php
$this->widget('application.widgets.news.LentaNewsWidget', array (
    'count' => 7,
    'category_code' => 'news',
    'item_class' => 'col-sm-12 col-md-12',
    'show_all' => false,
    //                'ajax'=>true
));
?>

<div class="style-media">
    <div class="calendar_title">
        <h4><?php echo Yii::t('app', 'archive_news') ?></h4>
    </div>
    <?php
    $this->widget('application.widgets.news.CalendarWidget', array (
        'url' => 'blog/calendar',
    ));
    ?>
</div>
