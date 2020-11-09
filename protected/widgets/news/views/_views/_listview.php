<div class=" <?php echo $this->item_class; ?> ">

    <div class="type-post style-media-list media links-level-4 colheight-index">
        <div class="inner_block">
            <?php if($data->getDocument()) {?> 
                <span class="media-object pull-left" >
                    <?php echo CHtml::link(CHtml::image($data->getThumbPath(80, 60, 'auto', true), $title), $data->url, array('class' => "thumb")); ?>
                </span>
            <?php } ?>
            <div class="media-body" >
                <h3 class="entry-title">
                    <?php
                    $title = $data->getTitle();
                    echo CHtml::link(Yii::app()->controller->truncate($title, 20, 400), $data->url, array('alt' => $title,'title' => $title, 'rel' => 'bookmark'));
                    ?>
                </h3>
            </div>
        </div>
    </div>

</div>