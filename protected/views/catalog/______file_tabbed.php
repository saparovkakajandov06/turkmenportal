<div class="form">
    <div class="control-group">
        <?php echo CHtml::label(Yii::t('app', 'fileupload'), '', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php
           
            if (isset($files)) {
                $this->widget('XUpload', array(
                    'url' => Yii::app()->createUrl("//site/fileupload", array('state_name' => 'state_catalog')),
                    //our XUploadForm
                    'model' => $files,
                    //We set this for the widget to be able to target our own form
                    'htmlOptions' => array('id' => 'catalog-form'),
                    'attribute' => 'file',
                    'multiple' => true,
                    'autoUpload' => true,
//                    'showForm' => false,
//                  'maxNumberOfFiles'=>10
                    )
                );
            }
            ?>
        </div>
    </div>
</div>