<?php
$this->breadcrumbs = array(
    Yii::t('app', 'Polls Answers') => array('index'),
    Yii::t('app', $model->id),
);if(!isset($this->menu) || $this->menu === array()) {
$this->menu=array(
	array('label'=>Yii::t('app', 'Update') , 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('app', 'Delete') , 'url'=>'#', 'htmlOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Create') , 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage') , 'url'=>array('admin')),
	/*array('label'=>Yii::t('app', 'List') , 'url'=>array('index')),*/
);
}
?>

<h1><?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView', array(
'data' => $model,
'attributes' => array(
array(
                        'name'=>'id',
                        'visible'=>Yii::app()->getModule('user')->isAdmin()
                    ),'polls_id','views','likes','dislikes',array(
                        'name'=>'status',
                        'type'=>'boolean'
                    ),'edited_username','create_username','date_added','date_modified',)));?><h2><?php echo CHtml::link(Yii::t('app','Descriptions'), array('/pollsAnswersDescription'));?></h2>
<ul>
			<?php if (is_array($model->descriptions)) foreach($model->descriptions as $foreignobj) { 

					echo '<li>';
					echo CHtml::link($foreignobj->polls_answers_id, array('/pollsAnswersDescription/view','id'=>$foreignobj->id));
							
					}
						?></ul>