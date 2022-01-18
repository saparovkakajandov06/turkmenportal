<?php
//  $this->page_name=Yii::t('app', 'News');    

$this->breadcrumbs = array_merge(
    $this->breadcrumbs
//            $modelCategory->getBreadcrumbs(true)
);

$this->menu = array(
//    ((UserModule::isAdmin())
//        ? array('label' => UserModule::t('Manage Users'), 'url' => array('/user/admin'))
//        : array()),
    array('label' => UserModule::t('Profile'), 'url' => array('/user/profile')),
    array('label' => UserModule::t('Edit'), 'url' => array('/user/profile/edit')),
    array('label' => UserModule::t('Change password'), 'url' => array('/user/profile/changepassword')),
    array('label' => UserModule::t('Logout'), 'url' => array('/user/logout')),
);

?>
    <div class="box_header_index">
        <div class="header">
            <h1 class="headerColor"><?php echo Yii::t('app', 'item_add_form'); ?></h1>
        </div>
    </div>

    <div id="dynamicFormWrapper">

        <div class="form wide">

            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'item-form',
                'enableAjaxValidation' => false,
//            'enableClientValidation' => true,
//            'action'=>$model->isNewRecord ? Yii::app()->createUrl('//banner/create') : Yii::app()->createUrl('//banner/update',array('id'=>$model->id)),
                'htmlOptions' => array('enctype' => 'multipart/form-data'),
            ));
            echo $form->errorSummary($model);
            echo $form->hiddenField($model, 'username');
            ?>

            <div class="control-group">
                <?php echo CHtml::activelabelEx($model, 'title', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo CHtml::activetextField($model, 'title', array('size' => 60, 'maxlength' => 255, 'class' => 'item_title')); ?>
                    <?php echo $form->hiddenField($model, 'id'); ?>
                    <div class="help-inline">
                        <?php echo CHtml::error($model, 'title'); ?>
                    </div>
                </div>
            </div>

            <h3 class="formBlockHeader"><span>Ваши контактные данные</span></h3>


            <div class="control-group">
                <?php echo $form->labelEx($model, 'owner', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo $form->textField($model, 'owner'); ?>
                    <div class="help-inline"><?php echo $form->error($model, 'owner'); ?>
                    </div>
                </div>
            </div>

            <div class="control-group">
                <?php echo $form->labelEx($model, 'email', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo $form->textField($model, 'email'); ?>
                    <div class="help-inline" id="helpEmail"><?php echo $form->error($model, 'email'); ?>
                    </div>
                </div>
            </div>

            <div class="control-group">
                <?php echo $form->labelEx($model, 'phone', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo $form->textField($model, 'phone'); ?>
                    <div class="help-inline"><?php echo $form->error($model, 'phone'); ?>
                    </div>
                </div>
            </div>


            <h3 class="formBlockHeader"><span>Местоположение</span></h3>

            <div class="control-group">
                <?php echo $form->labelEx($model, 'region_id', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo CHtml::activedropDownList($model, 'region_id', Regions::model()->getListByParentCode('tm'), array('prompt' => Yii::t('app', '$LNG_CHOOSE_ONE'))); ?>
                    <div class="help-inline"><?php echo $form->error($model, 'region_id'); ?>
                    </div>
                </div>
            </div>


            <h3 class="formBlockHeader"><span>Параметры</span></h3>

            <div class="control-group">
                <?php echo $form->labelEx($model, 'category_id', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php
                    $categoryMydel = Category::model()->findByPk($model->category_id);
//                    if (!isset($categoryMydel) || !isset($categoryMydel->parent_id)) { ?>
                        <?php
                        echo CHtml::activeDropDownList($model, 'category_id', Category::model()->getAnnouncementCategories(), array('prompt' => Yii::t('app', '$LNG_CHOOSE_ONE'),
                            'class' => "category_id",
//                            'disabled' => (isset($categoryMydel) && isset($categoryMydel->parent_id)),
//                            'readonly' => isset($model->id),
                            'ajax' => array(
                                'type' => 'POST', //request type
                                'url' => CController::createUrl('item/category'), //url to call.
                                'beforeSend' => 'js:function(data){ 
                                       var loading=\'<div class="loading"></div>\'
                                       $("#dynamicForm").html(loading);
                                       fillDefaultForm();
                                    }',
                                'complete' => 'js:function(data){ 
                                       $("#dynamicForm .loading").remove();
                                    }',
                                'success' => 'js:function(data){ 
                                       $("#dynamicForm").html(data);
                                       checkRadioInputs();
                                    }',
                                //                   'update' => '#sub_category_id', //selector to update
                                'data' => 'js:jQuery(this).parents("form").find(".category_id").serialize()'
//                            'data' => 'js:jQuery(".category_id").serialize()'
                            )
                        ));
                        ?>
                        <div class="help-inline"><?php echo $form->error($model, 'category_id'); ?> </div>
                        <?php
//                    }
//                    elseif (isset($categoryMydel)) {
////                        $categoryMydel=Category::model()->findByPk($model->category_id);
//                        echo CHtml::label($categoryMydel->getFullTitle(false, ' / '), "", array('class' => 'category'));
//                        echo $form->hiddenField($model, 'category_id');
//                    }
                    ?>
                </div>
            </div>


            <div id="dynamicForm">
                <?php
                if (isset($dynamic_content)) {
                    echo $dynamic_content;
                }
                ?>

            </div>


            <div class="control-group">
                <?php echo CHtml::activelabelEx($model, 'description', array('class' => 'control-label', 'id' => 'item_description_label')); ?>
                <div class="controls">
                    <?php echo CHtml::activeTextArea($model, 'description'); ?>
                    <div class="help-inline">
                        <?php echo CHtml::error($model, 'description'); ?>
                    </div>
                </div>
            </div>


            <div class="control-group">
                <?php echo $form->labelEx($model, 'date_end', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo CHtml::activedropDownList($model, 'date_end', ItemForm::getDateEndOptions(), array('prompt1' => Yii::t('app', '$LNG_CHOOSE_ONE'))); ?>
                    <div class="help-inline"><?php echo $form->error($model, 'date_end'); ?>
                    </div>
                </div>
            </div>


            <div class="control-group" style="display: inline-block">
                <?php echo CHtml::label(Yii::t('app', 'item_fileupload'), '', array('class' => 'control-label', 'id' => 'item_photo_label')); ?>
                <div class="controls file-upload-input2">
                    <div class="sortable_container">
                        <?php
                        $this->widget('ext.xupload.widgets.RenderThumbsWidget', array(
                            'docs' => $model->documents,
                        ));
                        ?>


                        <?php
                        if (isset ($photos)) {
                            $this->widget('XUpload', array(
                                    'url' => Yii::app()->createUrl("//site/upload", array('state_name' => 'state_item')),
                                    //our XUploadForm
                                    'model' => $photos,
                                    //We set this for the widget to be able to target our own form
                                    'htmlOptions' => array('id' => 'item-form'),
                                    'attribute' => 'file',
                                    'multiple' => true,
                                    'autoUpload' => true,
                                    'showForm' => false,
                                    'prependFiles' => false,
                                    'formView' => 'form_item_upload',
                                    'showResultTable' => false,
                                    'showGlobalProgressBar' => false,
                                    'downloadView' => 'download_for_client',
                                    'uploadView' => 'upload_for_client',
                                    //                            'maxNumberOfFiles'=>10
                                )
                            );
                        }
                        ?>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="input-group col-sm-12">
            <span class="input-group-btn">
                <?php
                echo CHtml::submitButton(Yii::t('app', 'Save'), array('class' => 'btn btn-success', 'id' => 'validate'));
                echo '&nbsp;';
                echo CHtml::Button(Yii::t('app', 'Cancel'), array(
                        'submit' => 'javascript:history.go(-1)',
                        'class' => 'btn btn-inverse'
                    )
                );
                $this->endWidget();
                ?>
            </span>
                </div>
            </div>
        </div>
    </div>


<?php
Yii::app()->clientScript->registerScript('dynamicSelect', '

//// mask for phone number 
//document.getElementById(\'ItemForm_phone\').addEventListener(\'input\', function (e) {
//  var x = e.target.value.replace(/\D/g, \'\').match(/(\d{0,5})(\d{0,2})(\d{0,2})(\d{0,2})(\d{0,2})/);
//  e.target.value = !x[2] ? x[1] :  + x[1] + \' \' + x[2] + (x[3] ? \'-\' + x[3] : \'\') + (x[4] ? \'-\' + x[4] : \'\');
//});
//
//    function validateEmail(email) {
//      const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
//      return re.test(email);
//    }
//    
//    function validate() {
//      const $result = $("#helpEmail");
//      const email = $("#ItemForm_email").val();
//      $result.text("");
//    
//      if (!validateEmail(email)) {
//        $result.text("'.yii::t('app', 'email_validation').'");
//        $result.css("color", "red");
//      }
//      return false;
//    }
    

        $(function() {
            checkRadioInputs();
        });
        
        function checkRadioInputs(){
//            alert("ffs");
            $(".radio-inline").each(function(){
                if($(this).find("input[type=radio]").is(":checked"))
                    $(this).addClass("active");
                else
                    $(this).removeClass("active");
            });
        }

        $("#dynamicFormWrapper").on("click", "li.radio-inline", function(e) {
//                $(this).parents("ul").find(".radio-inline .active").removeClass("active");
                $(this).addClass("active");
                checkRadioInputs();
        });
        

        $("#dynamicFormWrapper").on("click", "#Auto_condition li.radio-inline", function(e) {
            var val=$("input:radio[name=\"Auto[condition]\"]:checked").val();
            if(typeof val!="undefined"){
                if(val==2){
                    $("#Auto_trip").prop("disabled", true);
                }else{
                    $("#Auto_trip").prop("disabled",false);
                }
            }
        });
        

        function fillDefaultForm(){
            $("#ItemForm_description").val("");
            $("#item_description_label").text("' . $model->getAttributeLabel("description") . '");
            $("#item_photo_label").html("' . Yii::t('app', 'item_fileupload') . '");
        }
        

    ', CClientScript::POS_READY);

//Yii::app()->clientscript
//    ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/assets/jquery-ui.min.loc.js', CClientScript::POS_END)
//
//    ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/assets/fileupload/tmpl.loc.min.js', CClientScript::POS_END)
//    ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/assets/fileupload/jquery.fileupload.min.js', CClientScript::POS_END)
//    ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/assets/fileupload/load-image.loc.min.js', CClientScript::POS_END)
//    ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/assets/fileupload/canvas-to-blob.loc.min.js', CClientScript::POS_END)
//    ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/assets/fileupload/jquery.iframe-transport.min.js', CClientScript::POS_END)
//    ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/assets/fileupload/jquery.fileupload-ip.min.js', CClientScript::POS_END)
//    ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/assets/fileupload/jquery.fileupload-ui.min.js', CClientScript::POS_END)
//    ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/assets/fileupload/jquery.fileupload.loc.min.js', CClientScript::POS_END);
?>