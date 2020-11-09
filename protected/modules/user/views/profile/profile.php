<?php $this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Profile");
//$this->breadcrumbs=array(
//	UserModule::t("Profile"),
//);
$this->menu = array(
//	((UserModule::isAdmin())
//		?array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin'))
//		:array()),
//        array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
    array('label' => UserModule::t('Profile'), 'url' => array('/user/profile')),
    array('label' => UserModule::t('Edit'), 'url' => array('/user/profile/edit')),
    array('label' => UserModule::t('Change password'), 'url' => array('/user/profile/changepassword')),
    array('label' => UserModule::t('Logout'), 'url' => array('/user/logout')),
);


?><?php $this->page_name = UserModule::t('Your profile'); ?>

<?php if (Yii::app()->user->hasFlash('profileMessage')): ?>
    <div class="success">
        <?php echo Yii::app()->user->getFlash('profileMessage'); ?>
    </div>
<?php endif; ?>


<table class="detail-view">

    <tr class="odd">
        <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('user_photo')); ?></th>
        <td><?php echo CHtml::image($model->getUserAvatar()); ?></td>
    </tr>
    <tr class="odd">
        <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('username')); ?></th>
        <td><?php echo CHtml::encode($model->username); ?></td>
    </tr>
    <?php
    $profileFields = ProfileField::model()->forOwner()->sort()->findAll();
    if (isset($profileFields) && isset($profile)) {
        foreach ($profileFields as $field) {
            ?>
            <tr class="event">
                <th class="label"><?php echo CHtml::encode(UserModule::t($field->title)); ?></th>
                <td><?php echo(($field->widgetView($profile)) ? $field->widgetView($profile) : CHtml::encode((($field->range) ? Profile::range($field->range, $profile->getAttribute($field->varname)) : $profile->getAttribute($field->varname)))); ?></td>
            </tr>
            <?php
        }
    }
    ?>
    <tr class="odd">
        <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('email')); ?></th>
        <td><?php echo CHtml::encode($model->email); ?></td>
    </tr>
    <tr class="event">
        <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('create_at')); ?></th>
        <td><?php echo $model->create_at; ?></td>
    </tr>
    <tr class="odd">
        <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('lastvisit_at')); ?></th>
        <td><?php echo $model->lastvisit_at; ?></td>
    </tr>
    <tr class="event">
        <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('status')); ?></th>
        <td><?php echo CHtml::encode(User::itemAlias("UserStatus", $model->status)); ?></td>
    </tr>
</table>

<h2>Связанные с аккаунтом сервисы::</h2>
<?php
$this->widget('ext.eauth.EAuthWidget', array(
    'action' => 'deleteService',
    'view' => 'linkedServices',
    'popup' => false,
    'predefinedServices' => $services
));
?>

<h2>Выберите сервис для привязки к аккаунту:</h2>
<?php
$allServices = array_keys(Yii::app()->eauth->getServices());
$this->widget('ext.eauth.EAuthWidget', array(
    'action' => 'login/login',
    'predefinedServices' => array_diff($allServices, $services)));
?>

