<?php
 $this->breadcrumbs = array(
    Yii::t('app', 'Add obyawa'),
);

?>


<div class="form wide obyawa_form">
    <p class="note">
        <?php echo Yii::t('app','obyawa_message1');?> 
    </p>
    <p class="note">
        <?php echo Yii::t('app','Fields with <span class="required">*</span> are required');?>.
    </p>

<div style="margin-bottom: 25px;"></div>

<?php
    $form = $this->beginWidget('CActiveForm', array(
                'id' => 'catalog_wrapper-form',
                'enableAjaxValidation' => false,
                'enableClientValidation' => true,
            ));
?>

    <div class="control-group">
           <?php echo CHtml::activeLabelEx($model, 'catalog_category_id', array('class' => 'control-label')); ?>
           <div class="controls">
               <?php
//               echo CHtml::activeDropDownList($model, 'catalog_category_id', Category::model()->getAnnouncementCategories(), array('prompt' => "", 'disabled' => isset($model->catalog_category_id) ? true : false,
               echo CHtml::activeDropDownList($model, 'catalog_category_id', Category::model()->getAnnouncementCategories(), array('prompt' => Yii::t('app','categories'), 
                   'class' => "catalog_category_id",
                   'ajax' => array(
                       'type' => 'POST', //request type
                       'url' => CController::createUrl('category/dynamicForms'), //url to call.
                       'beforeSend'=>'js:function(data){ 
                           var loading=\'<div class="loading"></div>\'
                           $("#dynamicForm").html(loading);
                        }',
                       'complete'=>'js:function(data){ 
                           $("#dynamicForm .loading").remove();
                        }',
                       'success'=>'js:function(data){ 
                           $("#dynamicForm").html(data);
                        }',
    //                   'update' => '#sub_category_id', //selector to update
                       'data' => 'js:jQuery(this).parents("form").serialize()'
                   )
               ));
               ?>
           </div>
    </div>
</div>

<?php
        $this->endWidget();
?>

<div class="horizontal_divider" style="margin-top: 2px;"></div>
<div id="dynamicForm"></div>

    <?php
        if(isset($model->catalog_category_id)){
             Yii::app()->clientScript->registerScript('dynamicSelect', "
                        $('#Catalog_catalog_category_id').trigger('change');
              ",  CClientScript::POS_READY);
        }
        
        Yii::app()->clientscript
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/assets/jquery-ui.min.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/assets/jquery.fileupload.js', CClientScript::POS_END)
//        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/assets/jquery.fileupload-ui.js', CClientScript::POS_END)
//        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/assets/jquery.fileupload-ip.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/assets/jquery.yiiactiveform.js', CClientScript::POS_END);
    ?>


<div id="confirmbox"></div>