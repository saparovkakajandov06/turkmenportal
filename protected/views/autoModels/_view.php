<div class="view">

    <h2><?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id' => $data->id)); ?></h2>

    <?php
    if (!empty($data->make_id)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('make_id')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->make_id);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
</div>