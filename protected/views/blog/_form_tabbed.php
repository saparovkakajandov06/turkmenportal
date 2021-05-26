<div class="wide form">
    <p class="note">
        <?php echo Yii::t('app', 'Fields with'); ?> <span
            class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
    </p>


    <div class="control-group">
        <?php echo $form->labelEx($model, 'parent_category_id', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->dropDownList($model, 'parent_category_id', Category::model()->getParentCategoriesList($model->parent_category_code_list), array(
                'class' => "category_id",
                'ajax' => array(
                    'type' => 'POST', //request type
                    'url' => CController::createUrl('category/dynamicSubCategories'), //url to call.
                    'update' => '#sub_category_id', //selector to update
                    'data' => 'js:jQuery(this).parents("form").serialize()'
                )
            )); ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'parent_category_id'); ?>
            </div>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'category_id', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php
            $categories = array();
            if (!isset($model->category_id)) {
                $categories = Category::model()->getListByParentCode('news');
            } else {
                $categories = Category::model()->getSiblingCategories($model->category_id);
            }
            ?>
            <?php echo $form->dropDownList($model, 'category_id', $categories, array('id' => "sub_category_id")); ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'category_id'); ?>
            </div>
        </div>
    </div>


    <div class="control-group">
        <?php echo $form->labelEx($model, 'worker_id', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php
            $workers = array();
            $workers = Workers::model()->getListWorkers();

            ?>
            <?php echo $form->dropDownList($model, 'worker_id', $workers, array('id' => "worker_id")); ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'worker_id'); ?>
            </div>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'client_id', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php
            $clients = array();
            $clients = Clients::model()->getListClients();

            ?>
            <?php echo $form->dropDownList($model, 'client_id', $clients, array('id' => "client_id")); ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'client_id'); ?>
            </div>
        </div>
    </div>

<!--    <div class="control-group">-->
<!--        <label for="regions">--><?php //echo Yii::t('app', 'Regions'); ?><!--</label>-->
<!--        <div class="controls">-->
<!--            <div class="row nm_row nm_regions">-->
<!--                --><?php
//                echo CHtml::checkBoxList(
//                    'Blog[regions]',
//                    array_keys(CHtml::listData($model->regions, 'id', 'id')),
//                    Regions::model()->getRegionsListByTree(),
//                    array('template' => "{beginLabel} {input} {labelTitle} {endLabel} ",
//                        'attributeitem' => 'id',
//                        'labelOptions' => array('style' => 'display:inline')
//                    )
//                );
//                ?>
<!--            </div>-->
<!--            <a class="select_all"-->
<!--               onclick="$(this).parent().find('.nm_regions :checkbox').attr('checked', true);">--><?php //echo Yii::t('app', "Select All"); ?><!--</a>/-->
<!--            <a class="select_none"-->
<!--               onclick="$(this).parent().find('.nm_regions :checkbox').attr('checked', false);">--><?php //echo Yii::t('app', "Select None"); ?><!--</a>-->
<!--        </div>-->
<!--    </div>-->


    <div class="control-group">
        <?php echo $form->labelEx($model, 'status', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->checkBox($model, 'status'); ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'status'); ?>
            </div>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'is_photoreport', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->checkBox($model, 'is_photoreport'); ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'is_photoreport'); ?>
            </div>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'is_rss', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->checkBox($model, 'is_rss'); ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'is_rss'); ?>
            </div>
        </div>
    </div>
    <div class="control-group">
        <?php echo $form->labelEx($model, 'is_interview', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->checkBox($model, 'is_interview'); ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'is_interview'); ?>
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
        <?php echo $form->labelEx($model, 'web', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'web'); ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'web'); ?>
            </div>
        </div>
    </div>
    <?php if (Yii::app()->user->getIsSuperuser()) { ?>
    <div class="control-group">
        <?php echo $form->labelEx($model, 'visited_count', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'visited_count'); ?>
            <div class="help-inline">
                <?php echo $form->error($model, 'visited_count'); ?>
            </div>
        </div>
    </div>
    <?php } ?>

    <?php if (Yii::app()->user->getIsSuperuser()) { ?>
        <div class="control-group">
            <?php echo $form->labelEx($model,'date_added',array('class'=>'control-label')) ; ?>
            <div class="controls">
                <?php $this->widget('CJuiDateTimePicker',
                    array(
                        'model'=>$model,
                        'name'=>'Blog[date_added]',
                        //'language'=> substr(Yii::app()->language,0,strpos(Yii::app()->language,'_')),
                        'language'=> '',
                        'value'=>$model->date_added,
                        'mode' => 'datetime',
                        'options'=>array(
                            'showAnim'=>'fold', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
                            'showButtonPanel'=>true,
                            'changeYear'=>true,
                            'changeMonth'=>true,
                            'dateFormat'=>'yy-mm-dd',
                        ),
                    )
                );
                ; ?>
                <div class="help-inline">
                    <?php echo $form->error($model,'date_added'); ?>
                </div>
            </div>
        </div>
    <?php } ?>

</div> <!-- form -->
