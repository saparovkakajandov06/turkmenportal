<?php $this->beginWidget('bootstrap.widgets.TbModal', array(
    'id' => 'Tbmodal',
    'autoOpen' => 'true',
    'htmlOptions' => array('style' => 'width: 800px;margin:auto;height:700px;background-color:#fff'),
));
?>

<div class="modal-header" style="background-color: #fff">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Image Options</h4>
</div>


<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'documents-form',
//        'action' => Yii::app()->createUrl('//documents/editDialog'),
//        'htmlOptions' => array ('enctype' => 'multipart/form-data'),
        'enableAjaxValidation' => false,
        'enableClientValidation' => false,
    ));

    echo $form->errorSummary($model);

    //    $videopath = $model->video_path;
//    $uploadfolder = trim(Yii::app()->params['uploadfolder'], '/');
    //    $thumbpatharray = explode("videos", $videopath);
    //    $thumbpath = Yii::app()->baseUrl . "/" . $uploadfolder . $thumbpatharray[0] . $model->name;

//    if (!isset($model->video_path) || strlen(trim($model->video_path)) > 2)
//        $thumbpath = "";
//    else {
//        $thumbpath = Yii::app()->baseUrl . "/" . $uploadfolder . "/" . $model->video_path;
//    }
    ?>


    <div class="modal-body" style="background-color: #fff">


        <?php echo $form->hiddenField($model, 'name'); ?>
        <?php echo $form->hiddenField($model, 'state_name'); ?>

        <?php
        $this->beginWidget('bootstrap.widgets.TbTabs', array(
                'id' => 'mytabs',
                'type' => 'tabs',
                'htmlOptions' => array('style' => 'min-height:150px;background-color:#fff;  border-bottom:1px solid #ddd;'),
                'tabs' => array(
                    array('id' => 'tab1', 'label' => 'TM', 'content' => $this->renderPartial('//documents/edit_form', array('model' => $model, 'form' => $form, 'l' => 'tm'), true, false), 'active' => true),
                    array('id' => 'tab2', 'label' => 'EN', 'content' => $this->renderPartial('//documents/edit_form', array('model' => $model, 'form' => $form, 'l' => 'en'), true, false)),
                    array('id' => 'tab3', 'label' => 'RU', 'content' => $this->renderPartial('//documents/edit_form', array('model' => $model, 'form' => $form, 'l' => 'ru'), true, false)),
//                    array ('id' => 'tab4', 'label' => 'Video and other', 'content' => $this->renderPartial('//documents/video_and_others', array ('model' => $model, 'form' => $form, 'videos' => $videos), true, false)),

                ),

            )
        ); ?>

        <?php $this->endWidget('bootstrap.widgets.TbTabs'); ?>
<!--        <div class="control-group">-->
<!--            --><?php //echo $form->labelEx($model, 'alt', array('class' => 'control-label')); ?>
<!--            <div class="controls">-->
<!--                --><?php //echo $form->textField($model, 'alt'); ?>
<!--                <div class="help-inline">-->
<!--                    --><?php //echo $form->error($model, 'alt'); ?>
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="control-group">-->
<!--            --><?php //echo $form->labelEx($model, 'caption', array('class' => 'control-label')); ?>
<!--            <div class="controls">-->
<!--                --><?php //echo $form->textArea($model, 'caption'); ?>
<!--                <div class="help-inline">-->
<!--                    --><?php //echo $form->error($model, 'caption'); ?>
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="control-group">-->
<!--            --><?php //echo $form->labelEx($model, 'author', array('class' => 'control-label')); ?>
<!--            <div class="controls">-->
<!--                --><?php //echo $form->textField($model, 'author'); ?>
<!--                <div class="help-inline">-->
<!--                    --><?php //echo $form->error($model, 'author'); ?>
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

        <div class="control-group">
            <?php echo $form->labelEx($model, 'is_main', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->checkBox($model, 'is_main'); ?>
                <div class="help-inline">
                    <?php echo $form->error($model, 'is_main'); ?>
                </div>
            </div>
        </div>

        <?php
        echo $this->renderPartial('//documents/video_and_others', array('model' => $model, 'form' => $form, 'videos' => $videos));
        ?>

    </div>

    <div class="modal-footer" style="background-color: #fff">


        <div class="col-md-12">
            <div class="form-actions">


                <?php
                echo CHtml::submitButton(Yii::t('app', 'Save'),
                    array('id' => 'close_edit_dialog' . uniqid(),
                        'class' => "btn btn-success",
                    )
                );
                ?>
            </div>
        </div>


        <?php $this->endWidget('CActiveForm'); ?>

    </div>
</div>

<?php $this->endWidget(); ?>

<?php
$uploadfolder = trim(Yii::app()->params['uploadfolder'], '/');

Yii::app()->clientScript->registerScript('scripts', "
    $('form#documents-form').submit(function(e) {
    e.preventDefault();    
    var formData = new FormData(this);
    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        success: function (data) {
             debugger;
             $('#Tbmodal .close').click();
        },
        cache: false,
        contentType: false,
        processData: false
    });
});



    
    $('div#dropzone-example').dropzone({ url: '" . $this->createUrl('site/videoupload') . "',
        paramName:'video',
        method:'post',
        maxFilesize: 20000,
        addRemoveLinks: true,
        removedfile: function(file) { 
            $('#Documents_video_path').val('');
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        },
        maxFiles: 1,
        error:function(file) { 
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        },
        
        init: function () {
            if('$model->video_path'!=''){
                var mockFile = { name: '" . $model->name . "', size: 100, type: 'image/jpeg' };       
                this.options.addedfile.call(this, mockFile);
                this.options.thumbnail.call(this, mockFile, '" . Yii::app()->baseUrl . "/" . $uploadfolder . "/" . $model->video_path . "');
                $('.dz-image img').css('width','100%');
            }
        },
        success : function(file, response){
            $('#Documents_video_path').val(response);
        },    
    });



    $('#btn_video_delete').on('click',function(){
        var path= $('#Documents_video_path').val();
        $.get( '" . $this->createUrl('documents/deletevideo', array('path' => $model->video_path)) . "', function( data ) {
        $('#banner_video').html('');
        $('#Documents_video_path').val('');
    });

})


//$('.btn-success').on('click',function(){
//    $('#Tbmodal .close').click();
//})


    
", CClientScript::POS_END);

?>
