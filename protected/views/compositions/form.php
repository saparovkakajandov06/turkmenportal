<?php    $form=$this->beginWidget('CActiveForm', array(
    'id'=>'compositions-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    ));
?>

    <div class="block-flat">
        <div class="header">
            <div class="row">
                <div class="col-xs-12 col-md-9">
                    <h3> <?php echo $this->form_name; ?> </h3>
                </div>
                <div class="col-xs-12 col-md-3 pull-right">
                     <div class="form-actions">
                        <?php
                            echo CHtml::submitButton(Yii::t('app', 'Save & Create'),array('class'=>'btn btn-success','name'=>"save_create"));
                            echo '&nbsp;';
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
                    <?php
                        echo $form->errorSummary($model);
//                        echo $form->errorSummary($descriptions);

                        $tabs = array();
                        $tabs[] = array('id' => 'description_tab', 'label' => Yii::t('app', 'Languages'), 'content' => $this->renderPartial('_descriptions_tab', array('model' => $model,'form' => $form), true, false), 'active' => true);
                        $tabs[] = array('id' => 'general_tab', 'label' => Yii::t('app', 'General'), 'content' => $this->renderPartial('_form_tabbed', array('model' => $model, 'form' => $form), true, false),);
                        $tabs[] = array('id' => 'image_tab', 'label' => Yii::t('app', 'Images'), 'content' => $this->renderPartial('_image_tabbed', array('photos' => $photos,'model' => $model), true, false),);


                        $this->widget('bootstrap.widgets.TbTabs', array(
                            "id" => "blog-form-tabs",
                            "type" => "tabs",
                            'tabs' => $tabs
                        ));
                    ?>            
                </div>
            </div>
        </div>
    </div>


<?php $this->endWidget(); ?>
