<?php
/* @var $this LocationsInfoController */
/* @var $data LocationsInfo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('location_id')); ?>:</b>
	<?php echo CHtml::encode($data->location_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('continent')); ?>:</b>
	<?php echo CHtml::encode($data->continent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('country_code')); ?>:</b>
	<?php echo CHtml::encode($data->country_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('country_flag')); ?>:</b>
	<?php echo CHtml::encode($data->country_flag); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('country_capital')); ?>:</b>
	<?php echo CHtml::encode($data->country_capital); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('country_phone')); ?>:</b>
	<?php echo CHtml::encode($data->country_phone); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('country_neighbours')); ?>:</b>
	<?php echo CHtml::encode($data->country_neighbours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('region')); ?>:</b>
	<?php echo CHtml::encode($data->region); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('city')); ?>:</b>
	<?php echo CHtml::encode($data->city); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('asn')); ?>:</b>
	<?php echo CHtml::encode($data->asn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('org')); ?>:</b>
	<?php echo CHtml::encode($data->org); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isp')); ?>:</b>
	<?php echo CHtml::encode($data->isp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('timezone')); ?>:</b>
	<?php echo CHtml::encode($data->timezone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('timezone_name')); ?>:</b>
	<?php echo CHtml::encode($data->timezone_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('timezone_gmt')); ?>:</b>
	<?php echo CHtml::encode($data->timezone_gmt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('currency')); ?>:</b>
	<?php echo CHtml::encode($data->currency); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('currency_code')); ?>:</b>
	<?php echo CHtml::encode($data->currency_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('currency_symbol')); ?>:</b>
	<?php echo CHtml::encode($data->currency_symbol); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('currency_rates')); ?>:</b>
	<?php echo CHtml::encode($data->currency_rates); ?>
	<br />

	*/ ?>

</div>