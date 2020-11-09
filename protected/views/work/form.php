<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'employees-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
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
                    echo CHtml::submitButton(Yii::t('app', 'Save'), array('class' => 'btn btn-success'));
                    echo '&nbsp;';
                    echo CHtml::Button(Yii::t('app', 'Cancel'), array(
                            'submit' => 'javascript:history.go(-1)',
                            'class' => 'btn btn-danger'
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
                $this->renderPartial('_form', array(
                        'model' => $model)
                );
                ?>
            </div>
        </div>
    </div>
</div>


<?php $this->endWidget(); ?>
