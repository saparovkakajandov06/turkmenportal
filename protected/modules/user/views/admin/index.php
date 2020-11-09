<?php
$this->breadcrumbs=array(
	UserModule::t('Users')=>array('/user'),
	UserModule::t('Manage'),
);

$this->menu=array(
    array('label'=>UserModule::t('Create User'), 'url'=>array('create')),
    array('label'=>UserModule::t('Manage Users'), 'url'=>array('admin')),
    array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
    array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
);

?>
<?php $this->page_name= UserModule::t("Manage Users"); ?>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'summaryText'=>false,
            'pagerCssClass'=>"pagination",
            'pager' => array('header' => '',
    //                    'CSS_HIDDEN_PAGE' => 'disabled',
                         'maxButtonCount' => 3,
                         'cssFile' => false,
                         'htmlOptions'=>array('class'=>'pagination pull-right'),
                         'prevPageLabel' => '<i class="fa fa-chevron-left"></i>',
                         'nextPageLabel' => '<i class="fa fa-chevron-right"></i>',
                         'firstPageLabel' => Yii::t('app','$LNG_FIRST'),
                         'lastPageLabel' => Yii::t('app','$LNG_LAST'),
        ),
	'columns'=>array(
		array(
			'name' => 'id',
			'type'=>'raw',
			'value' => 'CHtml::link(CHtml::encode($data->id),array("admin/update","id"=>$data->id))',
		),
		array(
			'name' => 'username',
			'type'=>'raw',
			'value' => 'CHtml::link(UHtml::markSearch($data,"username"),array("admin/view","id"=>$data->id))',
		),
		array(
			'name'=>'email',
			'type'=>'raw',
			'value'=>'CHtml::link(UHtml::markSearch($data,"email"), "mailto:".$data->email)',
		),
		'create_at',
		'lastvisit_at',
		array(
			'name'=>'superuser',
			'value'=>'User::itemAlias("AdminStatus",$data->superuser)',
			'filter'=>User::itemAlias("AdminStatus"),
		),
		array(
			'name'=>'status',
			'value'=>'User::itemAlias("UserStatus",$data->status)',
			'filter' => User::itemAlias("UserStatus"),
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
