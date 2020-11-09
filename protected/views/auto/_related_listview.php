<div class="col-md-4 col-xs-12 related_list big">

    <?php
    $thumb_path = $data->getThumbPath(330, 230, 'w', true);
    if (isset($thumb_path) && strlen(trim($thumb_path)) > 1) {
        ?>
        <span class="media-object responsive">
            <?php echo CHtml::link(CHtml::image($thumb_path, $title), $data->url, array('class' => "thumb")); ?>
        </span>
    <?php } ?>

    <div class="style-media-list">
        <h3 class="entry-title">
            <?php
            $title = $data->getTitle();
            echo CHtml::link(Yii::app()->controller->truncate($title, 20, 400), $data->url, array('alt' => $title, 'title' => $title, 'rel' => 'bookmark'));
            ?>
        </h3>
    </div>
</div>


<?php
if (isset($index) && $index == 4) { ?>
    <?php
    $this->widget('application.widgets.banners.BannersWidget', array(
        'type' => 'auto_related_desktop',
        'outer_css_class' => 'col-md-4 col-xs-12 related_list big',
        'outer_css_id' => 'auto_related_desktop',
    ));
    ?>
<?php } ?>
