<div class="afisha_view">
    <span class="media-object responsive">
        <?php echo CHtml::link(CHtml::image($data->getThumbPath(350, 201, 'w', true), ''), $data->url, array('class' => 'thumb')); ?>
    </span>


    <div class="entry-title afisha_view_title">
        <?php
        $title = Yii::app()->controller->truncate($data->getTitle(), 6, 70);
        echo CHtml::link($title, $data->url);
        ?>
        <div class="afisha_category">
            <?php echo CHtml::link($data->category->name, $data->category->url); ?>
        </div>
    </div>


    <!--    <p class="afisha_description">
        <?php //echo $data->getMixedDescriptionModel()->description; ?>
    </p>-->
</div>