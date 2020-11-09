<div class="form">
    <div class="control-group">
        <div class="controls file-upload-input backend">
            <div class="sortable_container" >
                <?php
                    $this->widget('ext.xupload.widgets.RenderThumbsWidget', array(
                        'docs' => $model->docs,
                    ));
                ?>

                <?php
                if(isset ($photos))
                {
                    $this->widget( 'XUpload', array(
                        'url' => Yii::app()->createUrl("//site/upload",array('state_name'=>'state_composition')),
                        //our XUploadForm
                        'model' => $photos,
                        //We set this for the widget to be able to target our own form
                        'htmlOptions' => array('id'=>'compositions-form'),
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