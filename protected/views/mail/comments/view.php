<div class="row">
    <div class="row" style="margin-top: 25px">
        <div class="col-md-7 col-xs-12">
            <?php if (isset($model->create_username) && strlen(trim($model->create_username)) > 2) { ?>
                <div style="display: block">
                    <div style="display: inline-block">
                        <?php echo $model->getAttributeLabel('create_username') . ": "; ?>
                    </div>
                    <div style="display: inline-block"><b> <?php echo $model->create_username; ?></b></div>
                </div>
            <?php } ?>

            <?php if (isset($model->edited_username) && strlen(trim($model->edited_username)) > 2) { ?>
                <div style="display:block">
                    <div style="display:inline-block">
                        <?php echo $model->getAttributeLabel('edited_username') . ": "; ?>
                    </div>
                    <div style="display:inline-block"><b> <?php echo $model->edited_username; ?></b></div>
                </div>
            <?php } ?>


            <?php if (isset($model->date_added) && strlen(trim($model->date_added)) > 2) { ?>
                <div style="display:block">
                    <div style="display:inline-block">
                        <?php echo $model->getAttributeLabel('date_added') . ": "; ?>
                    </div>
                    <div style="display:inline-block"><b> <?php echo $this->renderDateTime($model->date_added,true); ?></b></div>
                </div>
            <?php } ?>


            <?php if (isset($related) && isset($related->url)) { ?>
                <div style="display: block">
                    <div style="display: inline-block">
                        <?php echo Yii::t('app','source') . ": "; ?>
                    </div>
                    <div style="display: inline-block"><b><?php echo $related->url; ?></b></div>
                </div>
            <?php } ?>
        </div>


        <div class="row" style="margin-top: 25px">
            <?php if (isset($model->text)) { ?>
                <div style="display: block">
                    <div style="display: inline-block">
                        <?php echo Yii::t('app','comment') . ": "; ?>
                    </div>
                    <div style="display: inline-block"><b><?php echo $model->text; ?></b></div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>




