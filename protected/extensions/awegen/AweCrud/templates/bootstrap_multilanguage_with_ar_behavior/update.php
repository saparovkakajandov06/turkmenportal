<?php
echo "<?php\n";
$label = $this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs = array(
    Yii::t('app', '$label') => array('index'),
    Yii::t('app', \$model->{$this->getIdentificationColumn()}) => array('view','".Awecms::getPrimaryKeyColumn($this)."'=>\$model->".Awecms::getPrimaryKeyColumn($this)."),
    Yii::t('app', 'Update'),
);";
?>

if(!isset($this->menu) || $this->menu === array())
$this->menu=array(
	array('label'=>Yii::t('app', 'Delete') , 'url'=>'#', 'htmlOptions'=>array('submit'=>array('delete','id'=>$model-><?php echo Awecms::getPrimaryKeyColumn($this) ; ?>),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Create') , 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage') , 'url'=>array('admin')),
);
?>


<?php echo "<?php\n"; ?>
$this->form_name=Yii::t('app', 'Update')."<?php echo " ".$this->modelClass; ?>";
$this->renderPartial('form', array(
			'model' => $model,
                        'descriptions'=>$descriptions,
			'buttons' => 'update'));

?>
