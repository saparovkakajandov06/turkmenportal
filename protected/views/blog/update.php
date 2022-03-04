<?php
$this->breadcrumbs = array(
    Yii::t('app', 'Blogs') => array('index'),
    Yii::t('app', $model->id) => array('view', 'id' => $model->id),
    Yii::t('app', 'Update'),
);
if (!isset($this->menu) || $this->menu === array())
    $this->menu = array(
        array('label' => Yii::t('app', 'Delete'), 'url' => '#', 'htmlOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
        array('label' => Yii::t('app', 'Create'), 'url' => array('create')),
        array('label' => Yii::t('app', 'Manage'), 'url' => array('admin')),
    );
?>
<?php if (Yii::app()->user->hasFlash('error')):?>
<div class="alert alert-danger" role="danger">
    <?php echo Yii::app()->user->getFlash('error'); ?>
</div>
<?php endif;?>

<?php
$this->form_name = Yii::t('app', 'Update') . " Blog";
$this->renderPartial('form', array(
    'model' => $model,
    'photos' => $photos,
    'buttons' => 'update'));

?>
