<div class="form">
    <div class="control-group">
        <?php echo CHtml::label(Yii::t('app', 'image'), '', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php
            if (isset($photos)) {
                $this->widget('XUpload', array(
                        'url' => Yii::app()->createUrl("//site/upload", array('state_name' => 'state_auto')),
                        //our XUploadForm
                        'model' => $photos,
                        //We set this for the widget to be able to target our own form
                        'htmlOptions' => array('id' => 'auto-form'),
                        'attribute' => 'file',
                        'multiple' => true,
                        'autoUpload' => true,
                        'showForm' => false,
                        'showResultTable' => false,
                        'showGlobalProgressBar' => false,
    //                  'maxNumberOfFiles'=>10
                    )
                );
            }
            ?>
        </div>
    </div>
    
    <?php if(isset($model->documents)) {
        $uploadfolder=trim(Yii::app()->params['uploadfolder'],'/');
        ?>
        <table class="table table-striped">
            <tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery">
                <?php foreach ($model->documents as $document) {?>
                    <tr class="template-download fade in" style="height: 82px;">
                        <td class="preview">
                            <?php echo '<a href="'. $uploadfolder.$document->path.'" title="'.$document->name.'" rel="gallery" download="'.$document->name.'"><img src="'.$document->resize(120,120).'"></a>'; ?> 
                        </td>
                        <td class="name">
                            <?php echo '<a href="'. $uploadfolder.$document->path.'" title="'.$document->name.'" rel="gallery" download="'.$document->name.'">'.$document->name.'</a>'; ?> 
                        </td>
                        <td class="size"><span>-</span></td>
                        <td colspan="2"></td>

                        <td class="delete">
                                <input type="checkbox" name="delete" value="1">
                                <?php if(Yii::app()->controller->action->id=='create' || Yii::app()->controller->action->id=='update') {
                                    echo '<button  class="btn btn-danger" data-type="POST" data-url="'.Yii::app()->createUrl("//documents/delete",array('id'=>$document->id,'related_table_name'=>'tbl_auto_to_documents')).'">'; 
                                        echo '<i class="fa icon-trash icon-white"></i>';
                                        echo '<span>Delete</span>'; 
                                    echo '</button>'; 
                                } ?>
                        </td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
        
<!--        <div class="files2" data-toggle="modal-gallery" data-target="#modal-gallery" style="height: 86px;">
            
        </div>-->
    <?php } ?>
    
</div>