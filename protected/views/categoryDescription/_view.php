<div class="view">

    <h2><?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id' => $data->id)); ?></h2>

    <?php
    if (!empty($data->category_id)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('category_id')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->category_id);
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
    <?php
    if (!empty($data->meta_description)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('meta_description')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->meta_description);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->meta_keyword)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('meta_keyword')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->meta_keyword);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
</div>