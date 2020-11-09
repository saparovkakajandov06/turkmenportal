<div class="view">

    <h2><?php echo CHtml::encode($data->getAttributeLabel('edited_username')); ?>:</h2>
<h2><?php echo CHtml::link(CHtml::encode($data->edited_username), array('view', 'id' => $data->id)); ?></h2>

    <?php
    if (!empty($data->region_id)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('region_id')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->region_id);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
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
    if (!empty($data->mail)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('mail')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->mail);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->web)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('web')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->web);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->type == 1 ? 'True' : 'False');
                ?>

            </div>
        </div>
    <?php
    if (!empty($data->room)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('room')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->room);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->year)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('year')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->year);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->meter)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('meter')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->meter);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->price)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->price);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->rating)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('rating')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->rating);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->period)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('period')); ?>:</b>
            </div>
<div class="field_value">
                <?php
                echo date('D, d M y H:i:s', strtotime($data->period));
                ?>

        </div>
        </div>

        <?php
    }
    ?>
    <?php
    if (!empty($data->views)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('views')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->views);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->likes)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('likes')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->likes);
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
</div>