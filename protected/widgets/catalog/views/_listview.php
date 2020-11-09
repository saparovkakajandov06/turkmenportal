<div class="row">
<article class="type-catalog-item style-media-list media <?php echo $this->item_class; ?> colheight-index">
    <div class="inner_block">

        <?php if(isset($this->show_photo) && $this->show_photo==true && !isset($data->documents)){ ?>
            <span class="media-object pull-left">
                <?php echo CHtml::link(CHtml::image($data->getThumbPath(230,150),$title), $data->url, array( 'class'=>"thumb")); ?>
            </span>
        <?php }?>

    <div class="media-body">
            <h3 class="entry-title">
                    <?php
                    $title=$data->getTitle();
                    echo CHtml::link(Yii::app()->controller->truncate($title,8,250), $data->url, array('alt'=>$title,'title' => $title,'rel' => 'bookmark','class'=>'bold')); ?>
            </h3>
            <p class="entry-description">
                    <?php
                    $description=  strip_tags($data->getContent());
                    $description=Yii::app()->controller->truncate($description,8,250);
                    echo CHtml::link($description, $data->url, array('alt'=>$title,'title' => $title,'rel' => 'bookmark')); ?>
            </p>
    </div>
    </div>
</article>
</div>
