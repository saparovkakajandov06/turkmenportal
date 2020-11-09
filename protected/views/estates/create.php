<?php
$this->breadcrumbs = array(
    Yii::t('app', 'Estates') => array('index'),
    Yii::t('app', 'Create'),
);
if(!isset($this->menu) || $this->menu === array())
$this->menu=array(
	array('label'=>Yii::t('app', 'List'), 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Manage'), 'url'=>array('admin')),
);
?>

<?php
$this->form_name=Yii::t('app', 'Create New')." Estates";
$this->renderPartial('form', array(
			'model' => $model,
                        'descriptions'=>$descriptions,
			'buttons' => 'create'));

?>