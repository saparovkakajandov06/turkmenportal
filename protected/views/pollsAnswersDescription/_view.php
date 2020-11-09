<div class="view">

    <h2><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</h2>
<h2><?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?></h2>

    <?php
    if (!empty($data->polls_answers_id)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('polls_answers_id')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->polls_answers_id);
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
    if (!empty($data->answer)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('answer')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->answer);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
</div>