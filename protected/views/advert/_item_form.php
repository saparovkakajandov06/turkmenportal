 
    <?php $subcategories=Category::model()->getAnnouncementCategories($model->parent_category_id); ?>
    <?php if(isset($subcategories) && count($subcategories)>0){ ?>
        <div class="control-group">
            <?php echo CHtml::activelabelEx($model, 'catalog_category_id', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php // echo CHtml::activedropDownList($model, 'category_id', Category::model()->getListByParentId($model->catalog_category_id), array('id'=>"sub_category_id")); ?>
                <?php echo CHtml::activeDropDownList($model, 'catalog_category_id', $subcategories, 
                    array( 
                       'class' => "catalog_category_id",
    //                   'ajax' => array(
    //                       'type' => 'POST', //request type
    //                       'url' => CController::createUrl('item/category2'), //url to call.
    ////                        'beforeSend'=>'js:function(data){ 
    ////                           var loading=\'<div class="loading"></div>\'
    ////                           $("#dynamicForm").html(loading);
    ////                        }',
    ////                       'complete'=>'js:function(data){ 
    ////                           $("#dynamicForm .loading").remove();
    ////                        }',
    //                       'success'=>'js:function(data){ 
    //                           alert(data);
    //                        }',
    //    //                   'update' => '#sub_category_id', //selector to update
    //                       'data' => 'js:jQuery(this).parents("form").serialize()'
    //                   )
                   ));
                ?>
                <div class="help-inline">
                    <?php echo CHtml::error($model, 'category_id'); ?>
                </div>
            </div>
        </div>
    <?php } ?>



 
    <div class="control-group">
        <?php echo CHtml::activelabelEx($model, 'price', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo CHtml::activetextField($model, 'price', array('size' => 60, 'maxlength' => 255,'class'=>"mini_input")); ?>
            <?php echo CHtml::activeRadioButtonList($model, 'currency', ItemForm::getCurrencyOptions(),array('container'=>'ul','template'=>"<li class=\"radio-inline\">{input}{label}</li>","separator"=>"")); ?>
            <div class="help-inline">
                <?php echo CHtml::error($model, 'price'); ?>
            </div>
        </div>
    </div>
    

 
    

