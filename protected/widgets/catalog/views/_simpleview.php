<div class="row">
    <article class="type-catalog-item style-media-list media <?php echo $this->item_class; ?> colheight-index">
        <div class="inner_block ">
            <?php
            $title = $data->getTitle();

            if (isset($this->show_photo) && $this->show_photo == true && !isset($data->documents)) { ?>
                <span class=" pull-left media-object">
                <?php echo CHtml::link(CHtml::image($data->getThumbPath(40, 40, "h"), $title), $data->url, array('class' => "thumb", 'alt' => $title,)); ?>
            </span>
            <?php } ?>

            <div class="media-body">
                <h3 class="entry-title">
                    <?php
                    echo CHtml::link(Yii::app()->controller->truncate($title, 15, 450), $data->url, array('rel' => 'bookmark','title' => $title, 'class' => 'link')); ?>
                </h3>
            </div>

        </div>
    </article>
    <div class="">
        <div class="col-md-12">
            <hr>
        </div>
    </div>
</div>
