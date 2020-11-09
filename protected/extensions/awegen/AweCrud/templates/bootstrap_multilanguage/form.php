<?php echo '<?php'; ?>
    $form=$this->beginWidget('CActiveForm', array(
    'id'=>'<?php echo $this->class2id($this->modelClass); ?>-form',
    'enableAjaxValidation'=><?php echo $this->validation == 1 || $this->validation == 3 ? 'true' : 'false'; ?>,
    'enableClientValidation'=><?php echo $this->validation == 2 || $this->validation == 3 ? 'true' : 'false'; ?>,
    ));
?>

    <div class="block-flat">
        <div class="header">
            <div class="row">
                <div class="col-xs-12 col-md-10">
                    <h3> <?php echo '<?php'; ?> echo $this->form_name; ?> </h3>
                </div>
                <div class="col-xs-12 col-md-2 pull-right">
                     <div class="form-actions">
                        <?php echo "<?php
                            echo CHtml::submitButton(Yii::t('app', 'Save'),array('class'=>'btn btn-success'));
                            echo '&nbsp;';
                            echo CHtml::Button(Yii::t('app', 'Cancel'), array(
                                        'submit' => 'javascript:history.go(-1)',
                                        'class'  => 'btn btn-danger'
                                        )
                                  );\n";
                           ?>
                         ?>
                      </div>
                </div>
            </div>
        </div>


        <div class="content">
            <div class="row">
                <div class="col-xs-12">
                    <?php echo '<?php'; echo "\n";?>
                        echo $form->errorSummary($model);
                        echo $form->errorSummary($descriptions);

                        $tabs = array();
                        $tabs[] = array('id' => 'description_tab', 'label' => Yii::t('app', 'Languages'), 'content' => $this->renderPartial('_descriptions_tab', array('descriptions' => $descriptions, 'form' => $form), true, false), 'active' => true);
                        $tabs[] = array('id' => 'general_tab', 'label' => Yii::t('app', 'General'), 'content' => $this->renderPartial('_form_tabbed', array('model' => $model, 'form' => $form), true, false),);


                        $this->widget('bootstrap.widgets.TbTabs', array(
                            "id" => "<?php echo $this->class2id($this->modelClass); ?>-form-tabs",
                            "type" => "tabs",
                            'tabs' => $tabs
                        ));
                    ?>            
                </div>
            </div>
        </div>
    </div>


<?php echo '<?php'; ?><?php echo " \$this->endWidget(); ?>\n"; ?>