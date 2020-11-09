
<article class="type-post style-media-list media <?php echo $this->item_class; ?>">
    <div class="inner_block">

    <div class="media-body">
            <h3 class="entry-title">
                    <?php 
                    $title=$data->getTitle();
                    echo CHtml::link(Yii::app()->controller->truncate($title,6,200), Yii::app()->createUrl("//catalog/view", array('id' => $data->id)), array('alt'=>$title,'title' => $title,'rel' => 'bookmark')); ?>
            </h3>
    </div>
    </div>
</article>