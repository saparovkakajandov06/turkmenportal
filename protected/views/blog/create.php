<?php
$this->breadcrumbs = array(
    Yii::t('app', 'Blogs') => array('index'),
    Yii::t('app', 'Create'),
);
if(!isset($this->menu) || $this->menu === array())
$this->menu=array(
	array('label'=>Yii::t('app', 'List'), 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Manage'), 'url'=>array('admin')),
);
?>

<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="alert alert-success">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>

<?php if(Yii::app()->user->hasFlash('error')):?>
    <div class="alert alert-danger">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
<?php endif; ?>

<?php
$this->form_name=Yii::t('app', 'Create New')." Blog";
$this->renderPartial('form', array(
			'model' => $model,
//                        'descriptions'=>$descriptions,
                        'photos'=>$photos,
			'buttons' => 'create'));

?>