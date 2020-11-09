<div class="view">

    <h2><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</h2>
<h2><?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?></h2>

    <?php
    if (!empty($data->parent_id)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('parent_id')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->parent_id);
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
    <?php
    if (!empty($data->date_added)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('date_added')); ?>:</b>
            </div>
<div class="field_value">
                <?php
                echo date('D, d M y H:i:s', strtotime($data->date_added));
                ?>

        </div>
        </div>

        <?php
    }
    ?>
    <?php
    if (!empty($data->date_modified)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('date_modified')); ?>:</b>
            </div>
<div class="field_value">
                <?php
                echo date('D, d M y H:i:s', strtotime($data->date_modified));
                ?>

        </div>
        </div>

        <?php
    }
    ?>
    <?php
    if (!empty($data->edited_username)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('edited_username')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->edited_username);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->create_username)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('create_username')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->create_username);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
</div>