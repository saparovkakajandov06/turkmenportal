<!-- The file upload form used as target for the file upload widget -->
<?php if ($this->showForm) echo CHtml::beginForm($this -> url, 'post', $this -> htmlOptions);?>
 
    
<div class="form-uploader-item fileupload-buttonbar">
	<div class="span7">
		<!-- The fileinput-button span is used to style the file input field as button -->
            <span class="btn fileinput-button">
                <!--<i class="icon-plus icon-white"></i>-->
                <i class="i i-add-photo"></i>
                <!--<span><?php // echo Yii::t('app', 'Choose file'); ?></span>-->
                <?php
                    if ($this -> hasModel()) :
                        echo CHtml::activeFileField($this -> model, $this -> attribute, $htmlOptions) . "\n";
                    else :
                        echo CHtml::fileField($name, $this -> value, $htmlOptions) . "\n";
                    endif;
                ?>
            </span>
                
	</div>
</div>
    
    

<?php if($this->showResultTable){ ?>
<table class="table table-striped">
	<tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody>
</table>
<?php } ?>
<?php if ($this->showForm) echo CHtml::endForm();?>
