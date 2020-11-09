<div class="row">
<article class="type-catalog-item style-media-list media <?php echo $this->item_class; ?> colheight-index">
    <div class="inner_block ">
       
        <?php // if(isset($this->show_photo) && $this->show_photo==true && !isset($data->documents)){ ?>
            <span class=" pull-left media-object">
                <?php echo CHtml::link(CHtml::image($data->getThumbPath(40,40,"h"),$title), $data->getUrl(), array( 'class'=>"thumb")); ?>
            </span>
        <?php // }?>

        <div class="media-body">
                <h3 class="entry-title">
                        <?php 
                        $title=$data->getTitle();
                        echo CHtml::link(Yii::app()->controller->truncate($title,8,250), $data->getUrl(), array('alt'=>$title,'rel' => 'bookmark','class'=>'bold')); ?>
                </h3>
        </div>
        
    </div>
</article>
</div>
