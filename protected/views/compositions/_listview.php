
<article class="type-post style-media-list media col-md-6  links-level-4 colheight-index">
    <div class="inner_block">
    <span class="media-object pull-left">
        <?php echo CHtml::link(CHtml::image($data->getThumbPath(70,40),$title), Yii::app()->createUrl("//compositions/view", array('id' => $data->id)), array( 'class'=>"thumb")); ?>
    </span>

    <div class="media-body">
            <h3 class="entry-title">
                    <?php 
                    $title=$data->getTitle();
                    echo CHtml::link(Yii::app()->controller->truncate($title,13,300), Yii::app()->createUrl("//compositions/view", array('id' => $data->id)), array('alt'=>$title, 'title' => $title,'rel' => 'bookmark')); ?>
            </h3>
    </div>
    </div>
</article>