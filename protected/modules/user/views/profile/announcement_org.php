 <?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("announcement");
$this->breadcrumbs=array(
	UserModule::t("Profile")=>array('profile'),
	UserModule::t("Edit"),
);

$this->menu=array(
	((UserModule::isAdmin())
		?array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin'))
		:array()),
    array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
    array('label'=>UserModule::t('Profile'), 'url'=>array('/user/profile')),
    array('label'=>UserModule::t('Change password'), 'url'=>array('changepassword')),
    array('label'=>UserModule::t('Logout'), 'url'=>array('/user/logout')),
);
?><h1><?php echo Yii::t('app','announcement'); ?></h1>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>



<?php
 
$this->widget('bootstrap.widgets.BootGridView', array(
    'id' => 'comments-grid',
    'type' => 'striped bordered condensed',
    'dataProvider' => $dataProvider,
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
        'title',
        array(
            'name' => 'text',
            'value' => 'CHtml::encode($data->title)',
            'type' => 'raw',
        ),
        array(
            'name' => 'text',
            'value' => 'get_class(CActiveRecord::model($data->material_class))',
            'type' => 'raw',
        ),
//        'category_id',
//        'create_username',
        'date_added',
//        'material_class',
        array(
            'class' => 'bootstrap.widgets.BootButtonColumn',
            'htmlOptions' => array('style' => 'width: 85px; text-align:right;','class'=>'button_grid button-column'),
            'template' => '{view}{update}',
            'buttons' => array(
                'view' => array(
                    'url' => '$data->material->url',
                    'options' => array(
//                        'class' => 'view'
                    ),
                ),
//                'update' => array(
//                    'url' => '$data->material->urlupdate',
//                    'options' => array(
////                        'class' => 'view'
//                    ),
//                ),
            ),
        ),
    ),
));
?>