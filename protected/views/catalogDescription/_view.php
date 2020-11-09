<div class="view">

    <h2><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</h2>
<h2><?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?></h2>

    <?php
    if (!empty($data->catalog_id)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('catalog_id')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->catalog_id);
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
    if (!empty($data->title)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->title);
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
    if (!empty($data->name)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->name);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->content)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->content);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
</div>