<?php $this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Profile");
$this->breadcrumbs = array(
    UserModule::t("Profile") => array('profile'),
    UserModule::t("Edit"),
);

$this->menu = array(
    array('label' => UserModule::t('Profile'), 'url' => array('/user/profile')),
    array('label' => UserModule::t('Edit'), 'url' => array('/user/profile/edit')),
    array('label' => UserModule::t('Change password'), 'url' => array('/user/profile/changepassword')),
    array('label' => UserModule::t('Logout'), 'url' => array('/user/logout')),
);
?><h1><?php echo UserModule::t('Edit profile'); ?></h1>

<?php if (Yii::app()->user->hasFlash('profileMessage')): ?>
    <div class="success">
        <?php echo Yii::app()->user->getFlash('profileMessage'); ?>
    </div>
<?php endif; ?>


<div class="form wide">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'profile-form',
        'enableAjaxValidation' => true,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )); ?>

    <p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

    <!--    --><?php //echo $form->errorSummary(array($model, $profile)); ?>

    <?php
    $error_array = array($model);
    if (isset($profile)) {
        $error_array[] = $profile;
    }
    echo $form->errorSummary($error_array);

    ?>

    <div class="user_photos_outer">
        <div class="control-group">
            <?php echo $form->labelEx($model, 'username'); ?>


            <div class="files " data-toggle="modal-gallery" data-target="#modal-gallery">
                <?php
                if (isset($model->documents) && is_array($model->documents)) { ?>
                    <?php foreach ($model->documents as $document) {
                        if (isset ($document->path)) {
                            ?>
                            <div class="haryt-image template-download fade in">

                                <div class="preview">
                                    <?php
                                    $profile_image = $document->resize(120, 100);
                                    $profile_image = Yii::app()->basePath . '/' . $profile_image;
                                    ?>
                                    <?php echo '<a href="' . $document->getUploadedPath($document->path) . '" title="' . $document->name . '" rel="gallery" download="' . $profile_image . '"></a>'; ?>
                                </div>
                                <?php if (Yii::app()->controller->action->id == 'edit' || Yii::app()->controller->action->id == 'create') { ?>
                                    <div class="delete" style="position: absolute; top: 0px; right: 0px;">
                                        <?php echo '<button style="margin: 0px;" class="btn" data-type="POST" data-url="' . Yii::app()->createUrl("//documents/delete", array('id' => $document->id)) . '">';
                                        echo '<i class="fa fa-times icon-white"></i>';
                                        echo '</button>' ?>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </div>

            <div class="controls">
                <?php
                if (isset($photos)) {
                    $this->widget('XUpload', array(
                            'url' => Yii::app()->createUrl("//site/upload", array('state_name' => 'state_user')),
                            //our XUploadForm
                            'model' => $photos,
                            //We set this for the widget to be able to target our own form
                            'htmlOptions' => array('id' => 'profile-form'),
                            'attribute' => 'file',
                            'multiple' => false,
                            'autoUpload' => true,
                            'showForm' => false,
                        )
                    );
                }
                ?>
            </div>
        </div>

    </div>


    <?php
    if (isset($profile)) {
        $profileFields = $profile->getFields();
        if (isset($profileFields)) {
            foreach ($profileFields as $field) {
                ?>
                <div class="control-group">
                    <?php echo $form->labelEx($profile, $field->varname, array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        if ($widgetEdit = $field->widgetEdit($profile)) {
                            echo $widgetEdit;
                        } elseif ($field->range) {
                            echo $form->dropDownList($profile, $field->varname, Profile::range($field->range));
                        } elseif ($field->field_type == "TEXT") {
                            echo $form->textArea($profile, $field->varname, array('rows' => 6, 'cols' => 50));
                        } else {
                            echo $form->textField($profile, $field->varname, array('size' => 60, 'maxlength' => (($field->field_size) ? $field->field_size : 255)));
                        }
                        ?>
                        <div class="help-inline">
                            <?php echo $form->error($profile, $field->varname); ?>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    }
    ?>
    <div class="control-group">
        <?php echo $form->labelEx($model, 'username'); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'username', array('size' => 20, 'maxlength' => 20)); ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'username'); ?>
            </div>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'email'); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 128)); ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'email'); ?>
            </div>
        </div>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save'), array('class' => 'btn btn-success')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
