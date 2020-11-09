<div class="view">

    <h2><?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id' => $data->id)); ?></h2>

    <?php
    if (!empty($data->information_id)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('information_id')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->information_id);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->language_id)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('language_id')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->language_id);
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