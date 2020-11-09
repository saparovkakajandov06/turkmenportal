<?php
$this->breadcrumbs=array(
	'backup'=>array('backup'),
	'Upload',
);
?>


 <div id="content_form_header">
      <h5><?php echo "Upload restore file" ?></h5>
  </div> 
<div class="form wide input_250 row-fluid">

<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'install-form',
	'enableAjaxValidation' => true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
));
?>
    <div class="span12">
        <div class="row">
        <?php echo $form->labelEx($model,'upload_file'); ?>
        <?php echo $form->fileField($model,'upload_file'); ?>
        <?php echo $form->error($model,'upload_file'); ?>
        </div>	
    </div>
                
                
                
    <div class="row buttons row-fluid"  > 
	<div class="span8">
		            <?php echo CHtml::submitButton(Yii::t('app', '$LNG_SAVE'),array('class'=>'btn btn-success')); 
                            
                             echo CHtml::link(
                                Yii::t('app','$LNG_CANCEL'), 
                                Yii::app()->createUrl("//backup/default/index"),
                                array(
                                    'onclick'=>'',
                                    'class'=>'form_cancel',
                                )
                            );
                            
                            ?>
            

	</div>
     </div>       
<?php	$this->endWidget();?>
</div>