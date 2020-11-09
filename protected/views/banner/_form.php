<div class="form row">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'banner-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'action' => $model->isNewRecord ? Yii::app()->createUrl('//banner/create') : Yii::app()->createUrl('//banner/update', array('id' => $model->id)),
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));

    echo $form->errorSummary($model);
    ?>

    <?php echo $form->hiddenField($model, 'type'); ?>

    <div class="row">

        <div class="col-md-2">
            <div class="control-group">
                <?php echo $form->labelEx($model, 'format_type', array('class' => 'control-label')); ?>
                <div class="controls file-upload-input backend">
                    <div class="sortable_container">
                        <?php
                        $this->widget('ext.xupload.widgets.RenderThumbsWidget', array(
                            'docs' => $model->docs,
                            'view' => 'download_for_client_editable',
                        ));
                        ?>

                        <?php
                        if (isset($photos)) {
                            $this->widget('XUpload', array(
                                    'url' => Yii::app()->createUrl("//site/upload", array('state_name' => 'state_banner')),
                                    //our XUploadForm
                                    'model' => $photos,
                                    //We set this for the widget to be able to target our own form
                                    'htmlOptions' => array('id' => 'banner-form'),
                                    'attribute' => 'file',
                                    'multiple' => false,
                                    'autoUpload' => true,
                                    'showForm' => false,
                                    'prependFiles' => false,
                                    'formView' => 'form_item_upload',
                                    'showResultTable' => false,
                                    'showGlobalProgressBar' => false,
                                    'downloadView' => 'download_for_client_editable',
                                    'uploadView' => 'upload_for_client',
                                    //                            'maxNumberOfFiles'=>10
                                )
                            );
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-3">
            <div class="control-group">
                <?php echo $form->labelEx($model, 'description', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo $form->textArea($model, 'description', array('size' => 60, 'maxlength' => 255, 'style' => "height: 70px;width: 100%;")); ?>
                    <div class="help-inline"><?php echo $form->error($model, 'description'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="control-group">
                <?php echo $form->labelEx($model, 'url', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo $form->textArea($model, 'url', array('style' => "height: 70px;width: 100%;")); ?>
                    <div class="help-inline"><?php echo $form->error($model, 'url'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-1">
            <div class="control-group">
                <?php echo $form->labelEx($model, 'related_user_id', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo $form->textField($model, 'related_user_id'); ?>
                    <!--                    --><?php //echo $form->dropDownList($model, 'related_user_id', CHtml::listData(User::model()->findAll(), 'id', 'username'), array('prompt' => "", 'id' => "related_username")); ?>
                    <div class="help-inline">
                        <?php echo $form->error($model, 'related_user_id'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="control-group">
                <?php echo $form->labelEx($model, 'date_expire', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php $this->widget('CJuiDateTimePicker',
                        array(
                            'model' => $model,
                            'name' => 'Banner[date_expire]',
                            //'language'=> substr(Yii::app()->language,0,strpos(Yii::app()->language,'_')),
                            'language' => '',
                            'value' => $model->date_expire,
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
                        <?php echo $form->error($model, 'date_expire'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="control-group">
                <?php echo $form->labelEx($model, 'status', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo $form->dropDownList($model, 'status', $model->getStatusOptions()); ?>
                    <div class="help-inline"><?php echo $form->error($model, 'status'); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
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
        </div>
    </div>
</div>
