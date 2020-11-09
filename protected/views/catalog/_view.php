<div class="view">

    <h2><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</h2>
    <h2><?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?></h2>

    <?php
    if (!empty($data->region_id) && strlen(trim($data->region_id))>0) {
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
    if (!empty($data->category_id) && strlen(trim($data->category_id))>0) {
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
    if (!empty($data->address) && strlen(trim($data->address))>0) {
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
    if (!empty($data->phone) && strlen(trim($data->phone))>0) {
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
    if (!empty($data->mail) && strlen(trim($data->mail))>0) {
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
    if (!empty($data->web) && strlen(trim($data->web))>0) {
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
    <?php
    if (!empty($data->rating) && strlen(trim($data->rating))>0) {
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