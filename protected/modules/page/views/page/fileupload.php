<?php    $form=$this->beginWidget('CActiveForm', array(
    'id'=>'page-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    ));
?>

    <div class="block-flat">
        <div class="header">
            <div class="row">
                <div class="col-xs-12 col-md-10">
                    <h3> <?php echo $this->form_name; ?> </h3>
                </div>
                <div class="col-xs-12 col-md-2 pull-right">
                     <div class="form-actions">
                        <?php
                            echo CHtml::submitButton(Yii::t('app', 'Save'),array('class'=>'btn btn-success'));
                            echo '&nbsp;';
                            echo CHtml::Button(Yii::t('app', 'Cancel'), array(
                                        'submit' => 'javascript:history.go(-1)',
                                        'class'  => 'btn btn-danger'
                                        )
                                  );
                         ?>
                      </div>
                </div>
            </div>
        </div>


        <div class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="control-group">
                        <?php echo $form->labelEx($model, 'title', array('class' => 'control-label')); ?>
                        <div class="controls">
                            <?php echo $form->hiddenField($model, 'id'); ?>
                            <?php echo $model->getTitle(); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <?php echo CHtml::label(Yii::t('app', 'fileupload'), '', array('class' => 'control-label')); ?>
                        <div class="controls file-upload-input backend">
                            
                            <div class="files " data-toggle="modal-gallery" data-target="#modal-gallery" >
                                <?php
                                    if(isset($model->files) && is_array($model->files)){ ?>
                                                <?php foreach ($model->files as $document) {
                                                    if(isset ($document->path)) {
                                                    ?>
                                                    <div class="haryt-image template-download fade in">
                                                        <div class="preview">
                                                            <?php echo '<a href="'.$document->getUploadedPath($document->path).'" title="'.$document->name.'" rel="gallery" download="'.$document->name.'"><img src="'.$document->getUploadedPath($document->path).'"></a>'; ?> 
                                                        </div>
                                                        <?php if(Yii::app()->controller->action->id=='fileupload') {?>
                                                            <div class="delete" style="position: absolute; top: 0px; right: 0px;">
                                                                <?php echo '<button style="margin: 0px;" class="btn" data-type="POST" data-url="'.Yii::app()->createUrl("//documents/delete",array('id'=>$document->id,'related_table_name'=>'tbl_page_to_files')).'">'; 
                                                                    echo '<i class="fa fa-times icon-white"></i>';
                                                                echo '</button>' ?>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                   <?php }?>
                                                <?php } ?>
                                    <?php } ?>
                            </div>
                            
                            <?php
                            if(isset ($files))
                            {
                                $this->widget( 'XUpload', array(
                                    'url' => Yii::app()->createUrl("//site/fileupload",array('state_name'=>'state_page_files')),
                                    //our XUploadForm
                                    'model' => $files,
                                    //We set this for the widget to be able to target our own form
                                    'htmlOptions' => array('id'=>'page-form'),
                                    'attribute' => 'file',
                                    'multiple' => true,
                                    'autoUpload'=>true,
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
            </div>
        </div>
    </div>


<?php $this->endWidget(); ?>