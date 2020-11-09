<?php
$this->breadcrumbs = array(
    Yii::t('app', 'Catalogs')
);
if(!isset($this->menu) || $this->menu === array())
$this->menu=array(
	array('label'=>Yii::t('app', 'Create'), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage'), 'url'=>array('admin')),
);
?>

<h1>Catalogs</h1>

<?php $this->widget('bootstrap.widgets.BootListView', array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
