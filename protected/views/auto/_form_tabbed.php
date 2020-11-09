<div class="wide form">
    <p class="note">
        <?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
    </p>


    <div class="control-group">
        <?php echo $form->labelEx($model, 'region_id', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->dropDownList($model, 'region_id', Regions::model()->getListByParentCode('tm'), array('prompt' => "")); ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'region_id'); ?>
            </div>
        </div>
    </div>



    <div class="control-group">
        <?php echo $form->labelEx($model, 'category_id', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->dropDownList($model, 'category_id', CategoryDescription::model()->getListByParentId($model->catalog_category_id), array('prompt' => "", 'id' => "sub_category_id")); ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'category_id'); ?>
            </div>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'phone', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'phone', array('size' => 60, 'maxlength' => 255)); ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'phone'); ?>
            </div>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'mail', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'mail', array('size' => 60, 'maxlength' => 255)); ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'mail'); ?>
            </div>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'web', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'web', array('size' => 60, 'maxlength' => 255)); ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'web'); ?>
            </div>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'model_id', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->dropDownList($model, 'model_id', CHtml::listData(AutoModels::model()->findAll(), 'id', 'name')); ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'model_id'); ?>
            </div>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'year', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'year', array('size' => 10, 'maxlength' => 10)); ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'year'); ?>
            </div>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'trip', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'trip', array('size' => 60, 'maxlength' => 255)); ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'trip'); ?>
            </div>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'price', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'price', array('size' => 60, 'maxlength' => 255)); ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'price'); ?>
            </div>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'rating', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'rating', array('size' => 60, 'maxlength' => 255)); ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'rating'); ?>
            </div>
        </div>
    </div>

   
    <div class="control-group">
                <?php echo $form->labelEx($model, 'status', array('class' => 'control-label')); ?>
        <div class="controls">
<?php echo $form->checkBox($model, 'status'); ?>
            <div class="help-inline">
<?php echo $form->error($model, 'status'); ?>
            </div>
        </div>
    </div>
</div> <!-- form -->