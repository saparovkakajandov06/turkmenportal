<article class="type-post style-media-list  <?php echo $this->item_class; ?> colheight-index ">
    <div class="inner_block row">
        <span class="media-object responsive pull-left" >
            <?php echo CHtml::link(CHtml::image($data->getThumbPath(60,40),$title), Yii::app()->createUrl("//blog/view", array('id' => $data->id)), array('class'=>"thumb")); ?>
        </span>

        <div class="media-body">

                <div class="entry-title">
                        <?php 
                            $title=$data->getTitle();
                            if($this->is_truncate==true)
                                $title=Yii::app()->controller->truncate($title,15,170);
                            echo CHtml::link($title, Yii::app()->createUrl("//blog/view", array('id' => $data->id)), array('alt'=>$title,'title' => $title,'rel' => 'bookmark'));
                        ?>
                </div>
        </div>
    </div>
</article>