 <div id="navigation">
               
                <div class="row-fluid navigation_top">
                    <div class="header_link pull-right">
                            <?php 
                            if(Yii::app()->user->id){
                                $model=User::model()->findByPk(Yii::app()->user->id);
                            ?>
                            <?php $user_fullname=$model->profile->firstname."  ".$model->profile->lastname; 
                                echo CHtml::link($user_fullname,Yii::app()->createUrl('//user/profile'));
                            ?>
                            <?php } ?>
                    </div>
                </div>
            </div>
            
            
            
            <?php
            $this->widget('ext.EUserFlash',array(
                        'bootstrapLayout' => true,
                        'bootstrapCloseButtons' => array('warning','notice','error','success'), //default
                    ));
            ?>


            <?php Yii::app()->clientScript->registerScript('fadeAndHideEffect', '$(".alert").animate({opacity: 1.0}, 5000).fadeOut("slow");', CClientScript::POS_READY); ?>
           
