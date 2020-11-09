<?php
$this->breadcrumbs = array(
    Yii::t('app', 'Branches') => array('index'),
    Yii::t('app', $model->name),
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

<h1><?php echo $model->name; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView', array(
'data' => $model,
'attributes' => array(
array(
                        'name'=>'id',
                        'visible'=>Yii::app()->getModule('user')->isAdmin()
                    ),'language_id','name',)));?>