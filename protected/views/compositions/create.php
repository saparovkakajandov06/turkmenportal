<?php
$this->breadcrumbs = array(
    Yii::t('app', 'Compositions') => array('index'),
    Yii::t('app', 'Create'),
);
if(!isset($this->menu) || $this->menu === array())
$this->menu=array(
	array('label'=>Yii::t('app', 'List'), 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Manage'), 'url'=>array('admin')),
);
?>

<h1> Create New Compositions </h1>
<?php
$this->renderPartial('form', array(
                        'model' => $model,
                        'photos'=>$photos,
			'buttons' => 'create'));

?>