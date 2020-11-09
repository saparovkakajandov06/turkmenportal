<div class="messages">
	<?php if( Yii::app()->user->hasFlash('RightsSuccess')===true ):?>

	    <div class="alert userflash alert-success">
            <button class="close" data-dismiss="alert">×</button>

	        <?php echo Yii::app()->user->getFlash('RightsSuccess'); ?>

	    </div>

	<?php endif; ?>

	<?php if( Yii::app()->user->hasFlash('RightsError')===true ):?>

	    <div class="flash alert-error">
            <button class="close" data-dismiss="alert">×</button>

	        <?php echo Yii::app()->user->getFlash('RightsError'); ?>

	    </div>

	<?php endif; ?>
</div>