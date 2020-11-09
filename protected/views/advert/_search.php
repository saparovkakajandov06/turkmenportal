<h4 class="block-title"><?php echo Yii::t('app', 'filter'); ?></h4>

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

    <div class="control-group <?= $filter_state ?>">
        <label class="control-label">
            <?php echo $model->getAttributeLabel('price'); ?>
            <i class="fa fa-chevron-right"></i>
            <i class="fa fa-chevron-down"></i>
        </label>
        <div class="controls">

            <?php echo $form->textField($model, 'price_start', array('class' => 'validate_number half_input')); ?>
            -
            <?php echo $form->textField($model, 'price_end', array('class' => 'validate_number half_input')); ?>
        </div>
    </div>


    <div class="control-group <?= $filter_state ?>">
        <label class="control-label">
            <?php echo $model->getAttributeLabel('year'); ?>
            <i class="fa fa-chevron-right"></i>
            <i class="fa fa-chevron-down"></i>
        </label>
        <div class="controls">
            <?php
            $year_list = array();
            $this_year = (int)date('Y');
            for ($i = $this_year; $i >= 1970; $i--) {
                $year_list[$i] = $i;
            }
            ?>
            <?php echo $form->dropDownList($model, 'year_start', $year_list, array('prompt' => "", 'class' => 'half_input')); ?>
            -
            <?php echo $form->dropDownList($model, 'year_end', $year_list, array('prompt' => "", 'class' => 'half_input')); ?>
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


    <div class="control-group">
        <div class="controls">
            <?php echo CHtml::submitButton(Yii::t('app', 'Search'), array('class' => 'btn btn-success')); ?>
            <?php echo CHtml::resetButton(Yii::t('app', 'Cancel'), array('class' => 'btn btn-default')); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->


<?php
Yii::app()->clientScript->registerScript('dynamicSelect', ' 

        $(".auto_filter .control-label").on("click",function(){
            wrapper=$(this).parent(".control-group");
            if(wrapper.hasClass("open")){
                wrapper.removeClass("open");
            }else{
                wrapper.addClass("open");
            }
        });
        
        $("#auto_filter_form").on("keyup change","input, select, textarea",function(){
            $.fn.yiiListView.update("auto-grid",{
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

<?php
//Yii::app()->clientScript->registerScript('dynamicSelect', '
//
//        $(\'.auto_filter .control-label\').on(\'click\',function(){
////            debugger;
//            wrapper=$(this).parent(\'.control-group\');
//            if(wrapper.hasClass(\'open\')){
//                wrapper.removeClass(\'open\');
//            }else{
//                wrapper.addClass(\'open\');
//            }
//        });
//
//
//        $("#auto_filter_form").on("keyup change","input, select, textarea",function(){
////            debugger;
//            $.fn.yiiListView.update("auto-grid",{
//                data:$("#auto_filter_form").serialize()
//            });
//        });
//
//
//
//
//
//    ',  CClientScript::POS_READY);
?>