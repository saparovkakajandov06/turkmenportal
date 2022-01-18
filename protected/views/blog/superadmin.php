<?php
$this->breadcrumbs = array(
    Yii::t('app', 'Blogs') => array('index'),
    Yii::t('app', 'Manage'),
);
if (!isset($this->menu) || $this->menu === array())
    $this->menu = array(
        array('label' => Yii::t('app', 'Create'), 'url' => array('create')),
        array('label' => Yii::t('app', 'List'), 'url' => array('index')),
    );
?>


    <h1> <?php echo Yii::t('app', 'Manage'); ?><?php echo Yii::t('app', 'Blogs'); ?> </h1>

<?php $this->widget('bootstrap.widgets.BootGridView', array(
    'id' => 'blog-grid',
    'type' => 'striped bordered condensed',
    'dataProvider' => $model->searchByLanguage(),
    'filter' => $model,
    'summaryText' => Yii::t('app', 'Displaying {start}-{end} of {count} result(s).'),
    'pagerCssClass' => "pagination",
    'pager' => array('header' => '',
        'maxButtonCount' => $this->maxButtonCount,
        'cssFile' => false,
        'htmlOptions' => array('class' => 'pagination pull-right'),
        'prevPageLabel' => '<i class="fa fa-chevron-left"></i>',
        'nextPageLabel' => '<i class="fa fa-chevron-right"></i>',
        'firstPageLabel' => Yii::t('app', '$LNG_FIRST'),
        'lastPageLabel' => Yii::t('app', '$LNG_LAST'),
    ),
    'columns' => array(
        array(
            'name' => 'id',
            'value' => '$data->id',
            'htmlOptions' => array('style' => 'text-align:center;width:30px;')
        ),
        array(
            'name' => 'title',
            'value' => '$data->getTitle()',
            'type' => 'raw',
        ),
//        array(
//            'name' => 'description',
//            'value' => 'Yii::app()->controller->truncate($data->getDescription(),10,150)',
//            'type' => 'raw',
//        ),
        array(
            'name' => 'sort_order',
            'value' => '$data->sort_order',
            'htmlOptions' => array('style' => 'text-align:center;width:20px;')
        ), array(
            'name' => 'visited_count',
            'value' => '$data->visited_count',
            'htmlOptions' => array('style' => 'text-align:center;width:20px;')
        ),
        array(
            'class' => 'JToggleColumn',
            'name' => 'is_photoreport',
            'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
            'model' => get_class($model),
            'htmlOptions' => array('style' => 'text-align:center;width:20px;')
        ),
        array(
            'class' => 'JToggleColumn',
            'name' => 'is_rss',
            'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
            'model' => get_class($model),
            'htmlOptions' => array('style' => 'text-align:center;width:20px;')
        ), array(
            'class' => 'JToggleColumn',
            'name' => 'is_interview',
            'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
            'model' => get_class($model),
            'htmlOptions' => array('style' => 'text-align:center;width:20px;')
        ),
        array(
            'class' => 'JToggleColumn',
            'name' => 'status',
            'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
            'model' => get_class($model),
            'htmlOptions' => array('style' => 'text-align:center;width:20px;')
        ),
        'date_added',
        'date_modified',
        'create_username',
        'edited_username',
        array(
            'name' => 'worker_id',
            'value' => function($model){
                $worker = Workers::model()->findByPk($model->worker_id);
                if(isset($worker)){
                    $result = $worker->nickname;
                } else {
                    $result = " ";
                }
                return $result;
            },
            'filter' => Workers::model()->getListWorkers(),
            'htmlOptions' => array('style' => 'text-align:center;width:20px;')
        ),

        array(
            'name' => 'client_id',
            'value' => function($model){
                if (isset($model->client_id)){
                    $client = Clients::model()->find('id ='.$model->client_id);
                }
                $result = " ";
                if(isset($client)){
                    $result = $client->client_name;
                } else {
                    $result = " ";
                }
                return $result  ;
            },
            'filter'=>  Clients::model()->getListClients(),
            'htmlOptions' => array('style' => 'text-align:center;width:20px;')
        ),
        array(
            'class' => 'bootstrap.widgets.BootButtonColumn',
            'htmlOptions' => array('style' => 'min-width: 100px; text-align:right;', 'class' => 'button_grid button-column'),
            'template' => '{view}{update}{crop}{delete}',
            'buttons' => array(
                'crop' => array(
                    'label' => Yii::t('app', 'Crop Main Image'),
                    'icon' => 'crop',
                    'url' => 'Yii::app()->createUrl("//documents/crop",array("id"=>$data->getDocument()->id,"class"=>get_class($data)))',
//                'imageUrl' => Yii::app()->request->baseUrl . '/images/postupdate2.png',
                    'options' => array(
//                    'ajax' => array(
//                        'type' => 'GET',
//                        'url' => "js:$(this).attr('href')",
//                        'update' => '#harytlar_post_update_dialog',
//                    ),
                        'class' => 'crop'
                    ),
                ),
            ),
        ),
    ),
)); ?>