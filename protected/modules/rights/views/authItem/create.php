<?php $this->breadcrumbs = array(
	'Rights'=>Rights::getBaseUrl(),
	Rights::t('core', 'Create :type', array(':type'=>Rights::getAuthItemTypeName($_GET['type']))),
); 
?>

<?php $this->renderPartial('/_menu'); ?>


<div class="createAuthItem">
<div id="content_form_header">
      <h5><?php echo Rights::t('core', 'Create :type', array(
		':type'=>Rights::getAuthItemTypeName($_GET['type']),
	)); ?></h5>
  </div> 
<div class="form wide input_250 row-fluid">
	<?php $this->renderPartial('_form', array('model'=>$formModel)); ?>

</div>
</div>