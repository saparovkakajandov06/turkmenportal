<div class=" row">
<article class=" simpleview  <?php echo $this->item_class; ?> ">
    <div class="inner_block ">
        <span class="icon_list">
        </span>
        
        <div class="media-body">
                <h5 class="entry-title">
                        <?php 
                        $title=$data->getTitle();
                        echo CHtml::link(Yii::app()->controller->truncate($title,15,450), $data->getUrl(), array('alt'=>$title,'title' => $title,'rel' => 'bookmark','class'=>'normal')); ?>
                </h5>
        </div>
        
    </div>
</article>
</div>
