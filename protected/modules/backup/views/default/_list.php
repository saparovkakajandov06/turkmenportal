<div class="harytlar-satylan">

<?php $this->widget('bootstrap.widgets.BootGridView', array(
	'id' => 'backup-grid',
        'summaryText'=>false,
        'pagerCssClass'=>"pagination",
        'type'=>'striped bordered condensed',
        'pager' => array('header' => '',
                        'maxButtonCount' => 3,
                        'cssFile' => false,
                         'htmlOptions'=>array('class'=>'pagination pull-right'),
                         'prevPageLabel' => '<i class="fa fa-chevron-left"></i>',
                         'nextPageLabel' => '<i class="fa fa-chevron-right"></i>',
                         'firstPageLabel' => Yii::t('app','$LNG_FIRST'),
                         'lastPageLabel' => Yii::t('app','$LNG_LAST'),
        ),
	'dataProvider' => $dataProvider,
	'columns' => array(
               array(
                    'name' => Yii::t('app','$LNG_NAIMENOVANIE'),
                    'value' => '$data["name"]',
                ),
               array(
                    'name' => Yii::t('app','$LNG_SIZE'),
                    'value' => '$data["size"]',
                ),
               array(
                    'name' => Yii::t('app','$LNG_DATE'),
                    'value' => '$data["create_time"]',
                ),
		array(
			'class' => 'CButtonColumn',
			'template' => ' {download} {restore}{delete}',
                        'buttons'=>array
			    (
			        'download' => array
			        (
			            'url'=>'Yii::app()->createUrl("backup/default/download", array("file"=>$data["name"]))',
                                    'imageUrl' => Yii::app()->theme->baseUrl . '/img/icons/download.png',
			        ),
			        'restore' => array
			        (
			            'url'=>'Yii::app()->createUrl("backup/default/restore", array("file"=>$data["name"]))',
                                    'imageUrl' => Yii::app()->theme->baseUrl . '/img/icons/restore.png',
                                ),
			        'delete' => array
			        (
			            'url'=>'Yii::app()->createUrl("backup/default/delete", array("file"=>$data["name"]))',
                                    'visible'=>'($data["name"]!="install.sql") ? true:false',
                                    'options' => array(
                                        'style'=>'margin-left:5px;',
                                    ),
			        ),
			    ),		
		),
    //		array(
    //			'class' => 'CButtonColumn',
    //			'template' => '{delete}',
    //			  'buttons'=>array
    //			    (
    //			        'delete' => array
    //			        (
    //			            'url'=>'Yii::app()->createUrl("backup/default/delete", array("file"=>$data["name"]))',
    //			        ),
    //			    ),		
    //		),
	),
)); ?>

</div>