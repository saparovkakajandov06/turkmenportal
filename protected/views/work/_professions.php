<div class="profession_block" style="display: none">
<?php
    $professionsModels=Professions::model()->findAll();
    foreach ($professionsModels as $profession){ ?>
        <div class="col-md-4"><?php
            echo CHtml::link($profession->name, Yii::app()->createUrl('//work/index',array('profession_id'=>$profession->id)));
        ?></div>
    <?php }?>
</div>