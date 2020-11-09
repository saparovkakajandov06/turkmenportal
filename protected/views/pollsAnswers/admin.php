<?php
$this->breadcrumbs = array(
    Yii::t('app', 'Polls Answers') => array('index'),
    Yii::t('app', 'Manage'),
);
if(!isset($this->menu) || $this->menu === array())
$this->menu=array(
    array('label'=>Yii::t('app', 'Create') , 'url'=>array('create')),
    array('label'=>Yii::t('app', 'List') , 'url'=>array('index')),
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('polls-answers-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1> <?php echo Yii::t('app', 'Manage'); ?> <?php echo Yii::t('app', 'Polls Answers'); ?> </h1>

<?php echo CHtml::link(Yii::t('app', 'Advanced Search'),'#',array('class'=>'search-button')); ?><div class="search-form" style="display: none">
    <?php $this->renderPartial('_search',array(
    'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php $this->widget('bootstrap.widgets.BootGridView', array(
'id' => 'polls-answers-grid',
'type'=>'striped bordered condensed',
'dataProvider' => $model->searchByLanguage(),
'filter' => $model,
'summaryText'=>Yii::t('app','Displaying {start}-{end} of {count} result(s).'),
'pagerCssClass'=>"pagination",
'pager' => array('header' => '',
             'maxButtonCount' => $this->maxButtonCount,
             'cssFile' => false,
             'htmlOptions'=>array('class'=>'pagination pull-right'),
             'prevPageLabel' => '<i class="fa fa-chevron-left"></i>',
             'nextPageLabel' => '<i class="fa fa-chevron-right"></i>',
             'firstPageLabel' => Yii::t('app','$LNG_FIRST'),
             'lastPageLabel' => Yii::t('app','$LNG_LAST'),
),
'columns' => array(
        'id',
        'polls_id',
      array(
                    'name' => 'answer',
                    'value' => '$data->answer',
                    'type' => 'raw',
            ),
        array(
            'class' => 'JToggleColumn',
            'name' => 'status',
            'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
            'model' => get_class($model),
            'htmlOptions' => array('style' => 'text-align:center;min-width:60px;')
        ),
        array(
'class'=>'bootstrap.widgets.BootButtonColumn',
'htmlOptions'=>array('style'=>'width: 85px; text-align:right;'),
),
),
)); ?>