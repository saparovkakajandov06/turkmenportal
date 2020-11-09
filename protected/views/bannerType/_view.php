<div class="view">

    <h2><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</h2>
<h2><?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?></h2>

    <?php
    if (!empty($data->type_name)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('type_name')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->type_name);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->width)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('width')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->width);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->height)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('height')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->height);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
</div>