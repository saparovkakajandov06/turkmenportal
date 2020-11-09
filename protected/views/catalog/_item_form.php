 <?php $subcategories=Category::model()->getAnnouncementCategories($model->parent_category_id); ?>
    <?php if(isset($subcategories) && count($subcategories)>0){ ?>
        <div class="control-group">
            <?php echo CHtml::activelabelEx($model, 'catalog_category_id', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php // echo CHtml::activedropDownList($model, 'category_id', Category::model()->getListByParentId($model->catalog_category_id), array('id'=>"sub_category_id")); ?>
                <?php echo CHtml::activeDropDownList($model, 'catalog_category_id', $subcategories, array( 'class' => "catalog_category_id")); ?>
                <div class="help-inline">
                    <?php echo CHtml::error($model, 'category_id'); ?>
                </div>
            </div>
        </div>
    <?php } ?>

 
    <div class="control-group">
        <?php echo CHtml::activelabelEx($model, 'service_price', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo CHtml::activetextField($model, 'price', array('size' => 60, 'maxlength' => 255,'class'=>"mini_input")); ?>
            <?php echo CHtml::activeRadioButtonList($model, 'currency', ItemForm::getCurrencyOptions(),array('container'=>'ul','template'=>"<li class=\"radio-inline\">{input}{label}</li>","separator"=>"")); ?>
            <div class="help-inline">
                <?php echo CHtml::error($model, 'price'); ?>
            </div>
        </div>
    </div>
    
    <div class="control-group">
        <?php echo CHtml::activelabelEx($model, 'address', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo CHtml::activetextField($model, 'address', array('size' => 60, 'maxlength' => 255,'class'=>"")); ?>
            <div class="help-inline">
                <?php echo CHtml::error($model, 'address'); ?>
            </div>
        </div>
    </div>

    <div class="control-group">
        <?php echo CHtml::activelabelEx($model, 'web', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo CHtml::activetextField($model, 'web', array('size' => 60, 'maxlength' => 255,'class'=>"")); ?>
            <div class="help-inline">
                <?php echo CHtml::error($model, 'web'); ?>
            </div>
        </div>
    </div>
    
