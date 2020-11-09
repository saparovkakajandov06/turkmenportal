<div class="row-fluid search_block">
        <div class="span8">
            <h4 class="search_header"><?php echo CHtml::link(CHtml::encode($data->title),Yii::app()->createUrl('//blog/view',array('id'=>$data->blog->id))); ?></h4>
            <div class=""><?php echo CHtml::encode($data->description); ?> ...</div>
        </div>
</div>
