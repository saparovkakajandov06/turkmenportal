<div class="control-group">
    <?php echo $form->labelEx($model, 'video_path', array ('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->hiddenField($model, 'video_path'); ?>
        <div class="help-inline">
            <?php echo $form->error($model, 'video_path'); ?>
        </div>
    </div>
</div>

<div id="banner_video">
    <!--<button  id="btn_video_delete" style="position: absolute; float: revert; z-index: 100001; background-color: #fff;padding: 5px;">X</button>-->
</div>


<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/dropzone.css">
<div class="dropzone dz-square" id="dropzone-example"></div>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/dropzone.js"></script>