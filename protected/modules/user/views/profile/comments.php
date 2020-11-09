 <?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("comments");
$this->breadcrumbs=array(
	UserModule::t("Profile")=>array('profile'),
	UserModule::t("Edit"),
);

$this->menu=array(
//	((UserModule::isAdmin())
//		?array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin'))
//		:array()),
//    array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
    array('label' => UserModule::t('Profile'), 'url' => array('/user/profile')),
    array('label' => UserModule::t('Edit'), 'url' => array('/user/profile/edit')),
    array('label' => UserModule::t('Change password'), 'url' => array('/user/profile/changepassword')),
    array('label' => UserModule::t('Logout'), 'url' => array('/user/logout')),
);
?><h1><?php echo Yii::t('app','my_comments'); ?></h1>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>



<?php
 
$this->widget('bootstrap.widgets.BootGridView', array(
    'id' => 'comments-grid',
    'type' => 'striped bordered condensed',
    'dataProvider' => $commentsModel->searchForUsers(),
    'htmlOptions' => array('class' => 'table-tp'),
    'summaryText' =>false,
    'pagerCssClass' => "pagination",
    'pager' => array('header' => '',
//                    'maxButtonCount' => $this->maxButtonCount,
        'cssFile' => false,
        'htmlOptions' => array('class' => 'pagination pull-right'),
        'prevPageLabel' => '<i class="fa fa-chevron-left"></i>',
        'nextPageLabel' => '<i class="fa fa-chevron-right"></i>',
        'firstPageLabel' => Yii::t('app', '$LNG_FIRST'),
        'lastPageLabel' => Yii::t('app', '$LNG_LAST'),
    ),
    'columns' => array(
        'text',
        'like_count',
//        'dislike_count',
        'date_added',
    ),
));
?>