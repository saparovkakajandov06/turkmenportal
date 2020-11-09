<?php
$this->breadcrumbs=array(
	UserModule::t('Profile Fields')=>array('admin'),
	UserModule::t('Manage'),
);
$this->menu=array(
    array('label'=>UserModule::t('Create Profile Field'), 'url'=>array('create')),
    array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('admin')),
    array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin')),
);

?>
<?php $this->page_name=UserModule::t('Profile Fields'); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
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
		'id',
		array(
			'name'=>'varname',
			'type'=>'raw',
			'value'=>'UHtml::markSearch($data,"varname")',
		),
		array(
			'name'=>'title',
			'value'=>'UserModule::t($data->title)',
		),
		array(
			'name'=>'field_type',
			'value'=>'$data->field_type',
			'filter'=>ProfileField::itemAlias("field_type"),
		),
		'field_size',
		//'field_size_min',
		array(
			'name'=>'required',
			'value'=>'ProfileField::itemAlias("required",$data->required)',
			'filter'=>ProfileField::itemAlias("required"),
		),
		//'match',
		//'range',
		//'error_message',
		//'other_validator',
		//'default',
		'position',
		array(
			'name'=>'visible',
			'value'=>'ProfileField::itemAlias("visible",$data->visible)',
			'filter'=>ProfileField::itemAlias("visible"),
		),
		//*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
