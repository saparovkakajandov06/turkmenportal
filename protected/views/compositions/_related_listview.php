
<div class="col-md-6 col-xs-12 related_list big">
    <?php
    $title = $data->getTitle();
    ?>

    <span class="media-object responsive" >
        <?php echo CHtml::link(CHtml::image($data->getThumbPath(330,230,'w',true),$title), $data->url, array('class'=>"thumb")); ?>
    </span>


    <div class="style-media-list">
        <h3 class="entry-title">
            <?php
                echo CHtml::link(Yii::app()->controller->truncate($title, 20, 400), $data->url, array('alt' => $title, 'title' => $title, 'rel' => 'bookmark'));
            ?>
        </h3>
    </div>
</div>


<?php
if (isset($index) && $index == 4) { ?>
    <?php
    $this->widget('application.widgets.banners.BannersWidget', array(
        'type' => 'composition_desktop_related',
        'outer_css_class' => 'col-md-6 col-xs-12 related_list big',
        'outer_css_id' => 'composition_desktop_related',
    ));
    ?>
<?php } ?>
