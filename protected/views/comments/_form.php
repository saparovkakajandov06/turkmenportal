<div class="form comments">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
                'id' => 'comments-form',
                'enableAjaxValidation' => true,
                'action' => Yii::app()->createUrl('//comments/create'),
            ));

    ?>
    <?php echo $form->hiddenField($model,'parent_id'); ?>            
    <?php echo $form->hiddenField($model,'related_relation'); ?>            
    <?php echo $form->hiddenField($model,'related_relation_id'); ?>            

    <div class="control-group">
        <div class="controls">
            <?php echo $form->textArea($model, 'text', array('placeholder' => isset($model->parent_id) ? Yii::t('app','your_reply') : Yii::t('app','your_comment'))); ?>
            <div class="help-inline"><?php echo $form->error($model, 'text'); ?>
            </div>
        </div>
    </div>


    <div class="form-actions">
        <?php
        
        echo CHtml::ajaxSubmitButton(isset($model->parent_id) ? Yii::t('app','$LNG_REPLY') : Yii::t('app','$LNG_ADD'),CHtml::normalizeUrl(array('//comments/create','render'=>false)),
            array('success'=>'js:function(data){
                    $(".comment_btn").removeAttr("disabled");
                    var data = $.parseJSON(data);
                    var alertMsg = "'.yii::t('app', 'comment_success_alert').'";
                    if(data.status=="success"){
//                          $.fn.yiiListView.update("comments_listview",{});   
                          var url=document.location.href;
                          $.ajax({
                                method:"GET",
                                url:url,
                                data:{"ajax":"comments_listview"},
                                success: function (data, textStatus, result) { 
                                    $("#comments_listview").html($(data).find("#comments_listview"));
                                     swal({
                                        title: "",
                                        text: alertMsg,
                                        type: textStatus,
                                        showCloseButton: true,
                                        showConfirmButton: false,
                                        timer: 5000
                                        //confirmButtonText: \'OK\'
                                    });
                                }     
                          });
                          $("#Comments_text").val("");
                    }
                    else{
                        alert(data.message);
                    }
                }',
                'beforeSend' => 'function(data,status){
                    $(".comment_btn").attr("disabled", "disabled");
                    $("#Comments_text").val("");
                }'
                ),

            array('id'=>'comments_adddd'.uniqid(),'class'=>"btn btn-success comment_btn")
            ); 
        $this->endWidget();
        ?>
    </div>
</div> <!-- form -->

<?php

 Yii::app()->clientscript
     ->registerCssFile(Yii::app()->theme->baseUrl . '/css/sweetalert2/sweetalert2.min.css')
     ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/sweetalert2/sweetalert2.min.js', CClientScript::POS_END);


?>