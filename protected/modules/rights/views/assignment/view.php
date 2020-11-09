<?php $this->breadcrumbs = array(
	'Rights'=>Rights::getBaseUrl(),
	Rights::t('core', 'Assignments'),
); ?>

<div id="assignments">
<div class="inner-panel">
    <div class="tab-content-focused">
        <div class="menu_satysh row-fluid" >
            <h5 class="span4" style="margin-left: 10px;">
                <?php $this->pageTitle=Rights::t('core', 'Assignments'); ?>
            </h5>
    </div>
        <div class="harytlar-satylan">

	<?php $this->widget('zii.widgets.grid.CGridView', array(
	    'dataProvider'=>$dataProvider,
	    'template'=>"{items}\n{pager}",
	    'emptyText'=>Rights::t('core', 'No users found.'),
	    'htmlOptions'=>array('class'=>'grid-view assignment-table'),
	    'columns'=>array(
    		array(
    			'name'=>'name',
    			'header'=>Rights::t('core', 'Name'),
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'name-column'),
    			'value'=>'$data->getAssignmentNameLink()',
    		),
    		array(
    			'name'=>'assignments',
    			'header'=>Rights::t('core', 'Roles'),
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'role-column'),
    			'value'=>'$data->getAssignmentsText(CAuthItem::TYPE_ROLE)',
    		),
			array(
    			'name'=>'assignments',
    			'header'=>Rights::t('core', 'Tasks'),
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'task-column'),
    			'value'=>'$data->getAssignmentsText(CAuthItem::TYPE_TASK)',
    		),
			array(
    			'name'=>'assignments',
    			'header'=>Rights::t('core', 'Operations'),
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'operation-column'),
    			'value'=>'$data->getAssignmentsText(CAuthItem::TYPE_OPERATION)',
    		),
	    )
	)); ?>

</div>
</div>
</div>
</div>