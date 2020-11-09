<?php
$this->breadcrumbs = array(
    Yii::t('app', 'Categories') => array('index'),
    Yii::t('app', $model->id),
);
if (!isset($this->menu) || $this->menu === array()) {
    $this->menu = array(
        array('label' => Yii::t('app', 'Update'), 'url' => array('update', 'id' => $model->id)),
        array('label' => Yii::t('app', 'Delete'), 'url' => '#', 'htmlOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
        array('label' => Yii::t('app', 'Create'), 'url' => array('create')),
        array('label' => Yii::t('app', 'Manage'), 'url' => array('admin')),
            /* array('label'=>Yii::t('app', 'List') , 'url'=>array('index')), */
    );
}
?>

<h1><?php echo $model->id; ?></h1>

<?php
$this->widget('bootstrap.widgets.BootDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'name' => 'id',
            'visible' => Yii::app()->getModule('user')->isAdmin()
        ), array(
            'name' => 'image',
            'type' => 'image'
        ), 'parent_id', array(
            'name' => 'top',
            'type' => 'boolean'
        ), 'column', 'sort_order', array(
            'name' => 'status',
            'type' => 'boolean'
        ), 'date_added', 'date_modified',)));
?>
