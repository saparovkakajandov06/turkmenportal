<div class="form">
    <div class="row">

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'banner-type-form',
            'enableAjaxValidation' => false,
            'enableClientValidation' => true,
        ));

        echo $form->errorSummary($model);
        ?>

        <div class="row">
            <div class="col-xs-4">
                <div class="control-group">
                    <?php echo $form->labelEx($model, 'type_name', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo $form->textField($model, 'type_name', array('size' => 60, 'maxlength' => 255, 'readonly' => isset($model->type_name))); ?>
                        <div class="help-inline"><?php echo $form->error($model, 'type_name'); ?>
                        </div>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo $form->labelEx($model, 'description', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo $form->textField($model, 'description', array('size' => 60, 'maxlength' => 255)); ?>
                        <div class="help-inline"><?php echo $form->error($model, 'description'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-4">
                <div class="control-group">
                    <?php echo $form->labelEx($model, 'width', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo $form->textField($model, 'width'); ?>
                        <div class="help-inline"><?php echo $form->error($model, 'width'); ?>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo $form->labelEx($model, 'height', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo $form->textField($model, 'height'); ?>
                        <div class="help-inline"><?php echo $form->error($model, 'height'); ?>
                        </div>
                    </div>
                </div>


            </div>

            <div class="col-xs-4">
                <div class="control-group">
                    <?php echo $form->labelEx($model, 'type', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo $form->dropDownList($model, 'type', BannerType::getTypeOptions()); ?>
                        <div class="help-inline"><?php echo $form->error($model, 'type'); ?>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo $form->labelEx($model, 'status', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo $form->dropDownList($model, 'status', array(1 => 1, 0 => 0)); ?>
                        <div class="help-inline"><?php echo $form->error($model, 'status'); ?>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo $form->labelEx($model, 'is_mobile_enabled', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo $form->dropDownList($model, 'is_mobile_enabled', BannerType::getBannerTypeOptions()); ?>
                        <div class="help-inline"><?php echo $form->error($model, 'is_mobile_enabled'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
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
        </div>
    </div>
</div> <!-- form -->