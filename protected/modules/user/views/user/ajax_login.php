<div class="wide form login_wrapper">
    <div class="row">
        <div class="col-md-4 ">

            <h2 class="login_header"><?php echo UserModule::t("Login"); ?></h2>
            <!--<p class="controls" style="text-transform: uppercase; font-family: 'Open Sans Condensed';"><?php // echo Yii::t('app','with_datas_for_tp'); ?></p>-->
            <p class="controls">
                <?php echo Yii::t('app', 'dont_you_have_account'); ?>
                <?php echo CHtml::link(UserModule::t("Register"), Yii::app()->createUrl('/user/registration'), array('id' => 'ajax_register1'));
                ?>
            </p>
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'login-form',
                'enableAjaxValidation' => true,
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'validateOnChange' => false,
                    'validateOnType' => false,
                ),
                'action' => Yii::app()->createUrl('//user/login'),
            ));
            ?>

            <div class="control-group">
                <div class="controls">
                    <?php echo $form->textField($model, 'username', array('size' => 60, 'maxlength' => 255, 'placeholder' => $model->getAttributeLabel('username'))); ?>
                    <div class="help-inline">
                        <?php echo $form->error($model, 'username'); ?>
                    </div>
                </div>
            </div>

            <div class="control-group">
                <div class="controls">
                    <?php echo $form->passwordField($model, 'password', array('size' => 60, 'maxlength' => 255, 'placeholder' => $model->getAttributeLabel('password'))); ?>
                    <div class="help-inline">
                        <?php echo $form->error($model, 'password'); ?>
                    </div>
                </div>
            </div>


            <div class="control-group">
                <div class="row">
                    <div class="col-xs-7">
                        <div class="controls">
                            <?php echo $form->checkBox($model, 'rememberMe'); ?>
                            <?php echo $form->labelEx($model, 'rememberMe', array('class' => 'control-label remember_me')); ?>
                        </div>
                    </div>
                    <div class="col-xs-5">
                        <p class="controls">
                            <?php echo CHtml::link(UserModule::t("Lost Password?"), Yii::app()->getModule('user')->recoveryUrl); ?>
                        </p>
                    </div>
                </div>
            </div>


            <div class="action-footer">
                <?php
                echo CHtml::ajaxSubmitButton(UserModule::t('Login'), CHtml::normalizeUrl(array('/user/login', 'render' => false)),
                    array('success' => 'js:function(data){
                    console.log(data);
                         var data = $.parseJSON(data);
                         if(data.status=="success"){
                                $("#nav-popup-inner").html("");
                                $(".nav-popup").removeClass("opened");   
                                $(".nav-popup").slideUp(300);   
                                $(".ajaxLogin span.inner_text").text(data.user_fullname);
                                $(".ajaxLogin").parent("li.nav-all").removeClass("active");   
                                $(".background_glow").hide();
                        }
                        else{
                            $("#login-form .errorMessage").hide();
                            $.each(data, function(key, val) {
                                $("#login-form #"+key+"_em_").text(val);                                                    
                                $("#login-form #"+key+"_em_").show();
                            });
                        }     
                    }'),

                    array('id' => 'close_employees_create_dialog' . uniqid(), 'class' => "btn btn-success")
                );

                $this->endWidget(); ?>
            </div>

            <hr>
            <p class="controls">
                <?php echo Yii::t('app','or_login_with_social_services'); ?>
            </p>
            <?php
            $this->widget('ext.eauth.EAuthWidget', array(
                'action' => 'login'
            ));
            ?>
        </div>
        <div class="col-md-8 border-left">
            <h2 class="login_header"><?php echo UserModule::t("Registration"); ?></h2>

            <div class="text-info">
                <p>
                    Следите за последними новостями, столичными афишами, эксклюзивными фоторепортажами и о многом
                    интересном
                    о Туркменистане.
                </p>
                <p>
                    Ежедневно тысячи пользователей читают новости, обсуждают различные темы, ищут нужную информацию в
                    разных
                    каталогах, используя TURKMENPORTAL.COM.
                </p>
            </div>


            <div class="action-footer">
                <p>
                    Зарегистрируйтесь и будьте в курсе о последних событиях о Туркменистане!
                </p>
                    <?php echo CHtml::link(UserModule::t("Register"), Yii::app()->createUrl('/user/registration'),
//                        $ajaxOptions = array(
//                            'dataType'=>'text',
//                            'success' => 'js:function(data){
//                                debugger;
//                                $("#nav-popup-inner .login_wrapper").hide();
//                                postscribe("#nav-popup-inner", data,{
//                                    beforeWrite:function(str){
////                                        debugger;
//                                        return str;
//                                    }
//                                });
////                                console.log(data);
////                                $("#nav-popup-inner").html(data);
//                                $(".nav-popup").addClass("opened");
//                                $(".nav-popup").slideDown(500);
//                            }'
//                        ),
                        $htmlOptions = array('id' => 'ajax_register1','class'=>'btn btn-success')
                    );
                    ?>
            </div>
        </div>
    </div>
</div> <!-- form -->

