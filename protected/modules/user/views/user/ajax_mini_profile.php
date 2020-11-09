<?php
echo CHtml::link('<span class="fa fa-remove"></span>', '#', array('class' => 'close_panel'));

?>

<div class="row">
    <div class="col-md-4">
        <?php
        if (Yii::app()->user->id) {
            $userModel = User::model()->findByPk(Yii::app()->user->id);
            if (isset($userModel)) {
                echo CHtml::image($userModel->getUserAvatar(50, 50));
                echo '<span class="mini_profile_username">' . $userModel->profile->firstname . ' ' . $userModel->profile->lastname . ' (' . $userModel->username . ') </span>';
            }else{
                echo '<span class="mini_profile_username">' . Yii::app()->user->getName() . ' </span>';
            }
        }
        ?>
    </div>
    <div class="col-md-8">
        <div class="pull-right">
            <?php
            if (Yii::app()->user->checkAccess('Backend.Index')) {
//    if(UserModule::isAdmin()){
                $this->widget('bootstrap.widgets.TbButton', array(
                    'label' => Yii::t('app', 'Admin Panel'),
                    'icon' => 'fa fa-logout',
                    'type' => 'default', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size' => 'medium', // null, 'large', 'small' or 'mini'
                    'url' => Yii::app()->createUrl('//backend/index'),
                    'buttonType' => 'link',
                ));
            }
            ?>

            <?php if (!Yii::app()->user->isGuest && !Yii::app()->user->getState('service')) { ?>
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label' => Yii::t('app', 'My publications'),
                    'icon' => 'fa fa-logout',
                    'type' => 'default', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size' => 'medium', // null, 'large', 'small' or 'mini'
                    'url' => Yii::app()->createUrl('//user/announcement'),
                    'buttonType' => 'link',
                )); ?>
            <?php } ?>

            <?php if (!Yii::app()->user->isGuest && !Yii::app()->user->getState('service')) { ?>
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label' => Yii::t('app', 'My Profile'),
                    'icon' => 'fa fa-logout',
                    'type' => 'default', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size' => 'medium', // null, 'large', 'small' or 'mini'
                    'url' => Yii::app()->createUrl('//user/profile'),
                    'buttonType' => 'link',
                )); ?>
            <?php } ?>


            <?php if (Yii::app()->user->isGuest || Yii::app()->user->getState('service')) { ?>
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label' => UserModule::t("Register"),
                    'icon' => 'fa fa-user',
                    'type' => 'default', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size' => 'medium', // null, 'large', 'small' or 'mini'
                    'url' => Yii::app()->createUrl('//user/registration'),
                    'id' => 'ajax_register',
                    'buttonType' => 'link',
                )); ?>
            <?php } ?>

            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label' => Yii::t('app', 'Logout'),
                'icon' => 'fa fa-logout',
                'type' => 'default', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'size' => 'medium', // null, 'large', 'small' or 'mini'
                'url' => Yii::app()->createUrl('/user/logout'),
                'buttonType' => 'ajaxLink',
                'ajaxOptions' => array(
                    'success' => 'js:function(data){
                                location.reload();
//                                try {
                                    console.log(data);
                                    $("#nav-popup-inner").html(data);
                                    $("#nav-popup-inner").html("");
                                    $(".nav-popup").removeClass("opened");   
                                    $(".nav-popup").slideUp(300);   
                                    $(".background_glow").hide();
                                    $(".ajaxLogin span.inner_text").text("' . Yii::t('app', 'Login') . '");
                                    $(".ajaxLogin").parent("li.nav-all").removeClass("active");    
//                                 } catch (e) {
//                                        var data={
//                                            status:"error",
//                                            message:"Yalnyshlyk boldy tazeden barlap gorun"
//                                        }
//                                        console.log(data);
////                                        setMessage(data.status,data.message);
//                                 }
                            }'
                ),

            )); ?>
        </div>
    </div>
</div> <!-- form -->