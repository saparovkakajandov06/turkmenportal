<div class="afisha_view_vertical">
    <span class="media-object responsive">
        <?php echo CHtml::link(CHtml::image($data->getThumbPath(350,201,'w',true),''), $data->url, array('class'=>'thumb')); ?>
    </span>
<!--    <span class="afisha_category">-->
<!--        --><?php //echo CHtml::link($data->category->name,$data->category->url); ?>
<!--    </span>-->
    <div class="entry-title bottom-news">
         <?php echo CHtml::link($data->getTitle(),$data->url); ?>
    </div>

</div>