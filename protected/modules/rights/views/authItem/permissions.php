<?php $this->breadcrumbs = array(
	'Rights'=>Rights::getBaseUrl(),
	Rights::t('core', 'Permissions'),
); ?>

<div id="permissions">
<div class="inner-panel">
    <div class="tab-content-focused">
        <div class="menu_satysh row-fluid" >
            <h5 class="span4" style="margin-left: 10px;">
                <?php $this->pageTitle=Rights::t('core', 'Permissions'); ?>
            </h5>
    </div>
        <div class="harytlar-satylan">

	<p><?php echo CHtml::link(Rights::t('core', 'Generate items for controller actions'), array('authItem/generate'), array(
	   	'class'=>'generator-link',
	)); ?></p>

	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$dataProvider,
		'template'=>'{items}',
		'emptyText'=>Rights::t('core', 'No authorization items found.'),
		'htmlOptions'=>array('class'=>'grid-view permission-table'),
		'columns'=>$columns,
	)); ?>
        </div>

	<script type="text/javascript">

		/**
		* Attach the tooltip to the inherited items.
		*/
		jQuery('.inherited-item').rightsTooltip({
			title:'<?php echo Rights::t('core', 'Source'); ?>: '
		});

		/**
		* Hover functionality for rights' tables.
		*/
		$('#rights tbody tr').hover(function() {
			$(this).addClass('hover'); // On mouse over
		}, function() {
			$(this).removeClass('hover'); // On mouse out
		});

	</script>

</div>
</div>
</div>
