<?php
/* @var $this InfoCitiesController */
/* @var $model InfoCities */

$this->breadcrumbs=array(
	'Info Cities'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List InfoCities', 'url'=>array('index')),
//	array('label'=>'Create InfoCities', 'url'=>array('create')),
	array('label'=>'View InfoCities', 'url'=>array('view', 'id'=>$model->id)),
//	array('label'=>'Manage InfoCities', 'url'=>array('admin')),
);
?>

<h1>Update InfoCities <?php echo $model->id; ?></h1>

<?php //$this->renderPartial('_form', array('model'=>$model)); ?>




<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'info-cities-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
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
                        echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-success'));
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
                    //                        echo $form->errorSummary($descriptions);

                    $tabs = array();
                    $tabs[] = array('id' => 'description_tab', 'label' => Yii::t('app', 'Languages'), 'content' => $this->renderPartial('_descriptions_tab', array('model' => $model, 'form' => $form), true, false), 'active' => true);
                    //                    $tabs[] = array('id' => 'general_tab', 'label' => Yii::t('app', 'General'), 'content' => $this->renderPartial('_form_tabbed', array('model' => $model, 'form' => $form), true, false),);
                    //                    $tabs[] = array('id' => 'image_tab', 'label' => Yii::t('app', 'Images'), 'content' => $this->renderPartial('_image_tabbed', array('photos' => $photos, 'model' => $model), true, false),);


                    $this->widget('bootstrap.widgets.TbTabs', array(
                        "id" => "blog-form-tabs",
                        "type" => "tabs",
                        'tabs' => $tabs
                    ));
                    ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-12">
                    <?php echo $form->errorSummary($model); ?>

                    <div class="control-group">
                        <?php echo $form->labelEx($model,'citi_name'); ?>
                        <div class="controls">
                            <?php echo $form->textField($model,'citi_name',array('size'=>60,'maxlength'=>150)); ?>
                            <div class="help-inline">
                                <?php echo $form->error($model,'citi_name'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <?php echo $form->labelEx($model,'state'); ?>
                        <div class="controls">
                            <?php echo $form->textField($model,'state',array('size'=>10,'maxlength'=>10)); ?>
                            <div class="help-inline">
                                <?php echo $form->error($model,'state'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <?php echo $form->labelEx($model,'country'); ?>
                        <div class="controls">
                            <?php echo $form->textField($model,'country',array('size'=>10,'maxlength'=>10)); ?>
                            <div class="help-inline">
                                <?php echo $form->error($model,'country'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <?php echo $form->labelEx($model,'lon'); ?>
                        <div class="controls">
                            <?php echo $form->textField($model,'lon',array('size'=>10,'maxlength'=>10)); ?>
                            <div class="help-inline">
                                <?php echo $form->error($model,'lon'); ?>
                            </div>
                        </div>
                    </div>


                    <div class="control-group">
                        <?php echo $form->labelEx($model,'lat'); ?>
                        <div class="controls">
                            <?php echo $form->textField($model,'lat',array('size'=>10,'maxlength'=>10)); ?>
                            <div class="help-inline">
                                <?php echo $form->error($model,'lat'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <?php echo $form->labelEx($model, 'sort_order', array('class' => 'control-label')); ?>
                        <div class="controls">
                            <?php echo $form->textField($model, 'sort_order'); ?>
                            <div class="help-inline">
                                <?php echo $form->error($model, 'sort_order'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <?php echo $form->labelEx($model,'top'); ?>
                        <div class="controls">
                            <?php echo $form->checkBox($model,'top'); ?>
                            <div class="help-inline">
                                <?php echo $form->error($model,'top'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <?php echo $form->labelEx($model,'visibility'); ?>
                        <div class="controls">
                            <?php echo $form->checkBox($model,'visibility'); ?>
                            <div class="help-inline">
                                <?php echo $form->error($model,'visibility'); ?>
                            </div>
                        </div>
                    </div>


                    <div class="control-group">
                        <?php echo $form->labelEx($model,'status'); ?>
                        <div class="controls">
                            <?php echo $form->checkBox($model,'status'); ?>
                            <div class="help-inline">
                                <?php echo $form->error($model,'status'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


<?php $this->endWidget(); ?>