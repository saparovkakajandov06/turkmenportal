<div class="wide form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'catalog-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'action' => Yii::app()->createUrl('//catalog/generalCreate'),
    ));
    ?>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'category_id', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->dropDownList($model, 'category_id', Category::model()->getListByParentId($model->catalog_category_id), array('id'=>"sub_category_id")); ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'category_id'); ?>
            </div>
        </div>
    </div>
    
     <div class="control-group">
        <?php echo $form->labelEx($model,'title',array('class'=>'control-label')) ; ?>
        <div class="controls">
            <?php echo $form->textField($model,'title_'.Yii::app()->language,array('size'=>60,'maxlength'=>255)); ?>
            <div class="help-inline">
                  <?php echo $form->error($model,'title_'.Yii::app()->language); ?>
            </div>
        </div>
      </div>
    
    
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'description',array('class'=>'control-label')) ; ?>
        <div class="controls">
            <?php echo $form->textArea($model,'description_'.Yii::app()->language); ?>
            <div class="help-inline">
                  <?php echo $form->error($model,'description_'.Yii::app()->language); ?>
            </div>
        </div>
      </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'region_id', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->dropDownList($model, 'region_id', Regions::model()->getListByParentCode('tm'), array('prompt' => "")); ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'region_id'); ?>
            </div>
        </div>
    </div>


    <?php if($model->catalog_category_id==292) {?>
        <div class="control-group">
            <?php echo $form->labelEx($model, 'price', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($model, 'price', array('size' => 60, 'maxlength' => 255)); ?>
                <div class="help-inline">
                    <?php echo $form->error($model, 'price'); ?>
                </div>
            </div>
        </div>
    <?php } ?>
    
    
    <div class="control-group">
        <?php echo $form->labelEx($model, 'address', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'address', array('size' => 60, 'maxlength' => 255)); ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'address'); ?>
            </div>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'phone', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'phone', array('size' => 60, 'maxlength' => 255)); ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'phone'); ?>
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
        <?php echo $form->labelEx($model, 'web', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'web', array('size' => 60, 'maxlength' => 255)); ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'web'); ?>
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
//        echo CHtml::submitButton(Yii::t('app', 'Save'), array('class' => 'btn btn-success'));
        echo CHtml::ajaxSubmitButton(Yii::t('app', '$LNG_ADD'), CHtml::normalizeUrl(array('//catalog/generalCreate', 'render' => false)), array('success' => 'js:function(data){
                    var data = $.parseJSON(data);
                    if(data.status=="success"){
                        if (confirm(data.message)) {
                            location.href=data.redirect;
                        }else{
                            clientFormReset();
                        }
                    }
                    else
                    {
                        if (data.message.indexOf("{")==0) {
                           e = jQuery.parseJSON(data.message);
                           jQuery.each(e, function(key, value) { jQuery("#"+key+"_em_").show().html(value.toString()); });
                        }
                    }
                }'
                ), array('id' => 'close_auto_create_dialog' . uniqid(), 'class' => "btn btn-success")
        );
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