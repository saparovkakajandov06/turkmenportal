<div class="wide form">


    <?php
    $form = $this->beginWidget('CActiveForm', array(
                'id' => 'catalog-form',
                'enableAjaxValidation' => false,
                'enableClientValidation' => true,
            ));

    echo $form->errorSummary($model);
    echo $form->errorSummary($descriptionModel);
    ?>

    <p class="note">
        <?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
    </p>
    <div class="control-group">
            <?php echo $form->labelEx($model, 'category_id', array('class' => 'control-label')); ?>
        <div class="controls">
                <?php echo $form->dropDownList($model, 'category_id', CategoryDescription::model()->getListByParentCode('questions'), array('prompt' => "", 'id' => "sub_category_id")); ?>
            <div class="help-inline">
<?php echo $form->error($model, 'category_id'); ?>
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
            <?php echo $form->labelEx($descriptionModel, 'title', array('class' => 'control-label')); ?>
        <div class="controls">
                <?php echo $form->textArea($descriptionModel, 'title', array('size' => 60, 'maxlength' => 255)); ?>
            <div class="help-inline">
<?php echo $form->error($descriptionModel, 'title'); ?>
            </div>
        </div>
    </div>
    <div class="control-group">
            <?php echo $form->labelEx($descriptionModel, 'description', array('class' => 'control-label')); ?>
        <div class="controls">
                <?php echo $form->textArea($descriptionModel, 'description', array('size' => 60, 'maxlength' => 255)); ?>
            <div class="help-inline">
<?php echo $form->error($descriptionModel, 'description'); ?>
            </div>
        </div>
    </div>

    <div class="control-group">
            <?php echo CHtml::label(Yii::t('app', 'image'), '', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php
            if (isset($photos)) {
                $this->widget('XUpload', array(
                    'url' => Yii::app()->createUrl("//site/upload", array('state_name' => 'state_catalog')),
                    //our XUploadForm
                    'model' => $photos,
                    //We set this for the widget to be able to target our own form
                    'htmlOptions' => array('id' => 'catalog-form'),
                    'attribute' => 'file',
                    'multiple' => true,
                    'autoUpload' => true,
                    'showForm' => false,
                        //                            'maxNumberOfFiles'=>10
                        )
                );
            }
            ?>
        </div>
    </div>

    <div class="horizontal_divider"></div>


    <div class="form-actions">
        <?php
        echo CHtml::submitButton(Yii::t('app', 'Save'), array('class' => 'btn btn-success'));
        echo '&nbsp;';
        echo CHtml::Button(Yii::t('app', 'Cancel'), array(
            'submit' => 'javascript:history.go(-1)',
            'class' => 'btn btn-inverse'
                )
        );
        $this->endWidget();
        ?>
    </div>
</div> <!-- form -->