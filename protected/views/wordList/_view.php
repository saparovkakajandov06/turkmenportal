<?php
/* @var $this WordFilterController */
/* @var $data WordList */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('word')); ?>:</b>
	<?php echo CHtml::encode($data->word); ?>
	<br />


</div>