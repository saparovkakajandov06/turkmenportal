
<div class="wide form auto_filter index">
    <h4 class="index-auto-filter-title">
        <?php
            echo Yii::t('app','search from {old_count} old or {new_count} automobiles',array('new_count'=>$this->new_count,'old_count'=>$this->old_count))
        ?>
    </h4>

    <?php $form = $this->beginWidget('CActiveForm', array(
        'action' => $this->route,
        'method' => 'get',
        'id' => 'auto_filter_form',
    )); ?>


    <div class="control-group open">
        <label class="control-label">
            <?php echo $model->getAttributeLabel('make_id')." / ".$model->getAttributeLabel('model_id'); ?>
        </label>
        <div class="controls">
            <?php
            echo $form->dropDownList($model, 'make_id', AutoMakes::model()->getMakesList(), array('prompt' => Yii::t('app','select automake'),
                'class' => "make_id vertical_input full_input",
                'ajax' => array(
                    'type' => 'POST', //request type
                    'url' => Yii::app()->createUrl('autoModels/dynamicModels'), //url to call.
                    'update' => '#auto_model_id', //selector to update
                    'data' => 'js:jQuery(this).parents("form").serialize()'
                )
            ));
            ?>

            <?php echo $form->dropDownList($model, 'model_id', AutoModels::model()->getListByMakeId($model->make_id), array('prompt' => Yii::t('app','select automodel'), 'id' => "auto_model_id",'class'=>'full_input')); ?>
        </div>
    </div>


    <div class="control-group open">
        <label class="control-label">
            <?php echo $model->getAttributeLabel('price')." (".Yii::t('app','CURRENCY_MANAT').")"; ?>
        </label>
        <div class="controls">

            <?php echo $form->textField($model,'price_start',array('class'=>'validate_number half_input','placeholder'=>Yii::t('app','select start_price'))); ?>
            -
            <?php echo $form->textField($model,'price_end',array('class'=>'validate_number half_input','placeholder'=>Yii::t('app','select end_price'))); ?>
        </div>
    </div>



    <div class="control-group open">
        <label class="control-label">
            <?php echo $model->getAttributeLabel('year'); ?>
        </label>
        <div class="controls">
            <?php
            $year_list=array();
            $this_year=(int)date('Y');
            for($i=$this_year; $i>=1970; $i--){
                $year_list[$i]=$i;
            }
            ?>
            <?php echo $form->dropDownList($model, 'year_start',$year_list,array('prompt' => Yii::t('app',''),'class'=>'half_input')); ?>
            -
            <?php echo $form->dropDownList($model, 'year_end',$year_list,array('prompt' => Yii::t('app',''),'class'=>'half_input')); ?>
        </div>
    </div>






    <div class="control-group">
        <label class="control-label">
            <?php echo $model->getAttributeLabel('trip')." (".Yii::t('app','ODOMETER_KM').")"; ?>
        </label>
        <div class="controls">
            <?php echo $form->textField($model,'trip_start',array('class'=>'validate_number half_input','placeholder'=>Yii::t('app','select start_trip'))); ?>
            -
            <?php echo $form->textField($model,'trip_end',array('class'=>'validate_number half_input','placeholder'=>Yii::t('app','select end_trip'))); ?>
        </div>
    </div>






<!---->
<!--    <div class="control-group">-->
<!--        <label class="control-label">-->
<!--            --><?php //echo $model->getAttributeLabel('region_id'); ?>
<!--        </label>-->
<!--        <div class="controls">-->
<!--            --><?php //echo $form->dropDownList($model, 'region_id', Regions::model()->getListByParentCode('tm'), array('prompt' => "",'class'=>'full_input')); ?>
<!--        </div>-->
<!--    </div>-->



    <div class="control-group ">
        <label class="control-label">
            <?php echo $model->getAttributeLabel('auto_condition'); ?>
        </label>
        <div class="controls">
            <?php echo CHtml::activeCheckBoxList($model, 'auto_condition',$model->getAutoConditionOptions(),array('container'=>'ul','template'=>"<li class=\"filter-input\">{input}{label}</li>","separator"=>"")); ?>
        </div>
    </div>




    <div class="control-group">
        <div class="controls">
            <?php echo CHtml::submitButton(Yii::t('app', 'Search'),array('class'=>'btn btn-success','style'=>'    width: 99%;
    margin: 0 auto;
    display: block;')); ?>
<!--            --><?php //echo CHtml::resetButton(Yii::t('app', 'Cancel'),array('class'=>'btn btn-default')); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->



<?php
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
            $.fn.yiiListView.update("auto-grid",{
                data:$("#auto_filter_form").serialize()
            });
        });
        
        
        
       

    ',  CClientScript::POS_READY);
?>