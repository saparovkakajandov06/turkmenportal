<div class="view">

    <h2><?php echo CHtml::encode($data->getAttributeLabel('language_id')); ?>:</h2>
<h2><?php echo CHtml::link(CHtml::encode($data->language_id), array('view', 'id' => $data->id)); ?></h2>

    <?php
    if (!empty($data->estates_id)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('estates_id')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->estates_id);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->description)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->description);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
</div>