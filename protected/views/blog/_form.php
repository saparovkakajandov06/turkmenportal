<div class="form">
    <p class="note">
        <?php echo Yii::t('app', 'Fields with'); ?> <span
            class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
    </p>

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'blog-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
    ));

    echo $form->errorSummary($model);
    ?>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'image', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'image', array('size' => 60, 'maxlength' => 255));
            if (!empty($model->image)) { ?>
                <div class="right"><a href="<?php echo $model->image ?>" target="_blank"
                                      title="<?php echo Awecms::generateFriendlyName('image') ?>"><img
                        src="<?php echo $model->image ?>" alt="<?php echo Awecms::generateFriendlyName('image') ?>"
                        title="<?php echo Awecms::generateFriendlyName('image') ?>"/></a></div><?php }; ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'image'); ?>
            </div>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'like_count', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'like_count'); ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'like_count'); ?>
            </div>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'visited_count', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'visited_count'); ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'visited_count'); ?>
            </div>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'sort_order', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'sort_order'); ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'sort_order'); ?>
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

    <div class="control-group">
        <?php echo $form->labelEx($model, 'is_main', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->checkBox($model, 'is_main'); ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'is_main'); ?>
            </div>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'is_clients', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->checkBox($model, 'is_clients'); ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'is_clients'); ?>
            </div>
        </div>
    </div>
    <div class="control-group">
        <?php echo $form->labelEx($model, 'edited_username', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'edited_username', array('size' => 60, 'maxlength' => 255)); ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'edited_username'); ?>
            </div>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'date_added', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php $this->widget('CJuiDateTimePicker',
                array(
                    'model' => $model,
                    'name' => 'Blog[date_added]',
                    //'language'=> substr(Yii::app()->language,0,strpos(Yii::app()->language,'_')),
                    'language' => '',
                    'value' => $model->date_added,
                    'mode' => 'datetime',
                    'options' => array(
                        'showAnim' => 'fold', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
                        'showButtonPanel' => true,
                        'changeYear' => true,
                        'changeMonth' => true,
                        'dateFormat' => 'yy-mm-dd',
                    ),
                )
            );; ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'date_added'); ?>
            </div>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'date_modified', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php $this->widget('CJuiDateTimePicker',
                array(
                    'model' => $model,
                    'name' => 'Blog[date_modified]',
                    //'language'=> substr(Yii::app()->language,0,strpos(Yii::app()->language,'_')),
                    'language' => '',
                    'value' => $model->date_modified,
                    'mode' => 'datetime',
                    'options' => array(
                        'showAnim' => 'fold', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
                        'showButtonPanel' => true,
                        'changeYear' => true,
                        'changeMonth' => true,
                        'dateFormat' => 'yy-mm-dd',
                    ),
                )
            );; ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'date_modified'); ?>
            </div>
        </div>
    </div>
    <div class="row nm_row">
        <label for="categories"><?php echo Yii::t('app', 'Categories'); ?></label>
        <?php
        echo CHtml::checkBoxList('Blog[categories]', array_map('Awecms::getPrimaryKeyColumn', $model->categories),
            CHtml::listData(Category::model()->findAll(), 'id', 'id'),
            array('attributeitem' => 'id', 'checkAll' => Yii::t('app', 'Select All')));

        ?>
    </div>

    <div class="row nm_row">
        <label for="regions"><?php echo Yii::t('app', 'Regions'); ?></label>
        <?php
        echo CHtml::checkBoxList('Blog[regions]', array_map('Awecms::getPrimaryKeyColumn', $model->regions),
            CHtml::listData(Regions::model()->findAll(), 'id', 'id'),
            array('attributeitem' => 'id', 'checkAll' => Yii::t('app', 'Select All')));

        ?>
    </div>


    <div class="form-actions">
        <?php
        echo CHtml::submitButton(Yii::t('app', 'Save'), array('class' => 'btn btn-success'));
        echo '&nbsp;';
        echo CHtml::Button(Yii::t('app', 'Cancel'), array(
                'submit' => 'javascript:history.go(-1)',
                'class' => 'btn btn-inverse'
            )
        );
        $this->endWidget(); ?>
    </div>
</div> <!-- form -->