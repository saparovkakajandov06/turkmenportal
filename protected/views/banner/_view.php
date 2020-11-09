<div class="view">

    <h2><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</h2>
<h2><?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?></h2>

    <?php
    if (!empty($data->format_type)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('format_type')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->format_type);
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
    <?php
    if (!empty($data->type)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->type);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
</div>