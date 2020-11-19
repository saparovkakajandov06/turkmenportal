<?php
$this->breadcrumbs = array(
    Yii::t('app', 'Estates') => array('index'),
    Yii::t('app', $model->edited_username) => array('view','id'=>$model->id),
    Yii::t('app', 'Update'),
);
if(!isset($this->menu) || $this->menu === array())
$this->menu=array(
	array('label'=>Yii::t('app', 'Delete') , 'url'=>'#', 'htmlOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Create') , 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage') , 'url'=>array('admin')),
);
?>


<?php
$this->form_name=Yii::t('app', 'Update')." Estates";
$this->renderPartial('form', array(
			'model' => $model,
                        'descriptions'=>$descriptions,
			'buttons' => 'update'));

?>