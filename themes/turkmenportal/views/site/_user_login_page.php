<?php
$login_label = Yii::t('app', 'Login');
if (Yii::app()->user->id) {
    $model = User::model()->findByPk(Yii::app()->user->id);
    if (isset($model))
        $login_label = $model->username;
    else{
        $login_label = Yii::app()->controller->truncate(Yii::app()->user->getName(), 2, 12);
    }
}
?>
<li class="nav-all">
    <a href="<?php echo Yii::app()->createUrl('//user/login/login'); ?>" class="ajaxLogin">
        <span class="text"><span class="fa fa-user fa-lg"></span><span
                class="inner_text" style="display: none"><?php echo $login_label; ?></span></span>
        <span class="toggle fa fa-user fa-lg"></span>
    </a>
</li>