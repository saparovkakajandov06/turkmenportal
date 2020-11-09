 <!--noindex-->
<?php $this->beginWidget('DNofollowWidget'); ?>

    <div class="content opros">
        <h3><?php echo $pollsModel->getMixedDescriptionModel()->title; ?></h3>

        <div class="clearfix"></div>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'polls-form',
            'enableAjaxValidation' => false,
        ));
        ?>

        <div class="control-group opros_answers">
            <?php
            $pollsAnswerModel = new PollsAnswers();
            $data = array();
            foreach ($pollsAnswers as $pollsAnswer) {
                $data[$pollsAnswer->id] = $pollsAnswer->getMixedDescriptionModel()->answer;
            }
            echo CHtml::activeRadioButtonList($pollsAnswerModel, 'id', $data);
            ?>

            <div class="form-actions">
                <?php
                    echo CHtml::ajaxSubmitButton(Yii::t('app','Answer'),CHtml::normalizeUrl(array('//polls/answer','id'=>$pollsModel->id,'render'=>false)),
                    array('success'=>'js:function(data){
                            $(".opros").html(data);
                        }'),
                    array('id'=>'answer_polls'.uniqid(),'class'=>"btn btn-success")
                ); 

                echo '&nbsp;&nbsp;&nbsp;';
                echo CHtml::ajaxLink(Yii::t('app', 'Results'), Yii::app()->createUrl('/polls/results',array('id'=>$pollsModel->id)),$ajaxOptions=array(
                        'success'=>'js:function(data){
                                try {
                                    $(".opros").html(data);
                                 } catch (e) {
                                    console.log(e);
                                    console.log(data);
                                 }
                          }'
                ));
                
                
                $this->endWidget();
                ?>
            </div>
        </div>
    </div>
<?php $this->endWidget(); ?>
<!--/noindex-->