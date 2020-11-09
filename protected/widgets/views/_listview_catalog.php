
<article class="type-post style-media-list media <?php echo $this->item_class; ?> colheight-index">
    <div class="inner_block">
        <?php 
        if(isset($this->show_photo) && $this->show_photo==true){ ?>
            <span class="media-object pull-left">
                <?php echo CHtml::link(CHtml::image($data->getThumbPath(70,40),$title), Yii::app()->createUrl("//catalog/view", array('id' => $data->id)), array( 'class'=>"thumb")); ?>
            </span>
        <?php }?>

    <div class="media-body">
            <h3 class="entry-title">
                    <?php 
                    $title=$data->getTitle();
                    echo CHtml::link(Yii::app()->controller->truncate($title,8,250), Yii::app()->createUrl("//catalog/view", array('id' => $data->id)), array('alt'=>$title,'title' => $title,'rel' => 'bookmark')); ?>
            </h3>
    </div>
    </div>
</article>