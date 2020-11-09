<h4 class="block-title">Филтр</h4>

<div class="wide form auto_filter ">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
        'id' => 'auto_filter_form',
    ));

    $filter_state = 'open';
    if ($this->isMobile()) {
        $filter_state = '';
    }

    ?>


    <div class="control-group open">
        <label class="control-label">
            <?php echo $model->getAttributeLabel('profession_id'); ?>
            <i class="fa fa-chevron-right"></i>
            <i class="fa fa-chevron-down"></i>
        </label>
        <div class="controls">
            <?php echo $form->dropDownList($model, 'profession_id', CHtml::listData(Professions::model()->findAll(), 'id', 'name'), array('prompt' => "", 'class' => 'full_input')); ?>
        </div>
    </div>

    <!--  <div class="control-group open">-->
    <!--    <label class="control-label">-->
    <!--      --><?php //echo $model->getAttributeLabel('branch_id'); ?>
    <!--      <i class="fa fa-chevron-right"></i>-->
    <!--      <i class="fa fa-chevron-down"></i>-->
    <!--    </label>-->
    <!--    <div class="controls">-->
    <!--      --><?php //echo $form->dropDownList($model, 'branch_id', CHtml::listData(Branches::model()->findAllByAttributes(array('language_id'=>Yii::app()->session['current_lang_id']) ),'id','name'), array('prompt' => "",'class'=>'full_input')); ?>
    <!--    </div>-->
    <!--  </div>-->


    <div class="control-group <?= $filter_state ?>">
        <label class="control-label">
            <?php echo $model->getAttributeLabel('education'); ?>
            <i class="fa fa-chevron-right"></i>
            <i class="fa fa-chevron-down"></i>
        </label>
        <div class="controls">
            <?php echo $form->dropDownList($model, 'education', Work::model()->getEducationTypes(), array('prompt' => "", 'class' => 'full_input')); ?>
        </div>
    </div>


    <div class="control-group <?= $filter_state ?>">
        <label class="control-label">
            <?php echo $model->getAttributeLabel('experience'); ?>
            <i class="fa fa-chevron-right"></i>
            <i class="fa fa-chevron-down"></i>
        </label>
        <div class="controls">
            <?php echo $form->dropDownList($model, 'experience', Work::model()->getExperienceOptions(), array('prompt' => "", 'class' => 'full_input')); ?>
        </div>
    </div>


    <div class="control-group <?= $filter_state ?>">
        <label class="control-label">
            <?php echo $model->getAttributeLabel('schedule'); ?>
            <i class="fa fa-chevron-right"></i>
            <i class="fa fa-chevron-down"></i>
        </label>
        <div class="controls">
            <?php echo $form->dropDownList($model, 'schedule', Work::model()->getScheduleOptions(), array('prompt' => "", 'class' => 'full_input')); ?>
        </div>
    </div>


    <div class="control-group <?= $filter_state ?>">
        <label class="control-label">
            <?php echo $model->getAttributeLabel('region_id'); ?>
            <i class="fa fa-chevron-right"></i>
            <i class="fa fa-chevron-down"></i>
        </label>
        <div class="controls">
            <?php echo $form->dropDownList($model, 'region_id', Regions::model()->getListByParentCode('tm'), array('prompt' => "", 'class' => 'full_input')); ?>
        </div>
    </div>


    <div class="control-group <?= $filter_state ?>">
        <label class="control-label">
            <?php echo $model->getAttributeLabel('salary'); ?>
            <i class="fa fa-chevron-right"></i>
            <i class="fa fa-chevron-down"></i>
        </label>
        <div class="controls">

            <?php echo $form->textField($model, 'salary_start', array('class' => 'validate_number half_input')); ?>
            -
            <?php echo $form->textField($model, 'salary_end', array('class' => 'validate_number half_input')); ?>
        </div>
    </div>


    <!--  <div class="control-group ">-->
    <!--    <label class="control-label">-->
    <!--      --><?php //echo $model->getAttributeLabel('languages'); ?>
    <!--      <i class="fa fa-chevron-right"></i>-->
    <!--      <i class="fa fa-chevron-down"></i>-->
    <!--    </label>-->
    <!--    <div class="controls">-->
    <?php //echo CHtml::activeCheckBoxList($model, 'languages',$model->getTransmissionOptions(),array('prompt'=>Yii::t('app','$LNG_CHOOSE_ONE'),'container'=>'ul','template'=>"<li class=\"filter-input\">{input}{label}</li>","separator"=>"")); ?>
    <!--    </div>-->
    <!--  </div>-->


    <div class="control-group">
        <div class="controls">
            <?php echo CHtml::submitButton(Yii::t('app', 'Search'), array('class' => 'btn btn-success')); ?>
            <?php echo CHtml::resetButton(Yii::t('app', 'Cancel'), array('class' => 'btn btn-default')); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->


<?php
$url = $modelCategory->getUrl();
Yii::app()->clientScript->registerScript('dynamicSelect', ' 

        $(\'.auto_filter .control-label\').on(\'click\',function(){
//            debugger;
            wrapper=$(this).parent(\'.control-group\');
            if(wrapper.hasClass(\'open\')){
                wrapper.removeClass(\'open\');
            }else{
                wrapper.addClass(\'open\');
            }
        });
        
        
        $("#auto_filter_form").on("keyup change","input, select, textarea",function(){
//            debugger; 
            $.fn.yiiListView.update("work-grid",{
                url:"' . $url . '",
                beforeSend:function(){
                    SearchFunc();
                    var loading="<div class=\"loading\"></div>";
                    $(".level2_cont_right").prepend(loading);
                    $("body.mobilescreen .level2_cont_inner").prepend(loading);
                },
                complete:function(){
                       $(".loading").remove();
                },
                data:$("#auto_filter_form").serialize()
            });
        });
        
        
        
        function SearchFunc()   {
            var data = $("#auto_filter_form").serialize();
            var url = document.URL;
            var params = $.param(data);
            url = url.substr(0, url.indexOf(\'?\'));
            window.History.pushState(null, document.title,$.param.querystring(url, data));
        }
        
       
       

    ', CClientScript::POS_READY);
?>