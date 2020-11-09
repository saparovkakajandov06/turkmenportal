<div class="view">

    <h2><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</h2>
<h2><?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?></h2>

    <?php
    if (!empty($data->bottom)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('bottom')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->bottom);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->sort_order)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('sort_order')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->sort_order);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->status == 1 ? 'True' : 'False');
                ?>

            </div>
        </div>
</div>