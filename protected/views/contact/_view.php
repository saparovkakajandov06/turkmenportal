<div class="view">

    <h2><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</h2>
<h2><?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?></h2>

    <?php
    if (!empty($data->last_name)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('last_name')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->last_name);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->first_name)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('first_name')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->first_name);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->company_name)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('company_name')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->company_name);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->address)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->address);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->city)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('city')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->city);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->country)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('country')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->country);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->email)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::mailto($data->email);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->phone)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->phone);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->fax)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('fax')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->fax);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->comments)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('comments')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->comments);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
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