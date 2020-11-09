<div class="control-group">
    <?php echo $form->labelEx($model, 'title', array ('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->textField($model, 'title_' . $l); ?>

        <div class="help-inline">
            <?php echo $form->error($model, 'title_' . $l); ?>
        </div>
    </div>
</div>
