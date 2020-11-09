
<div class="row mobile_block">
    <?php
        $this->widget('bootstrap.widgets.BootListView',
        array('itemView'=>'//main/_view',//_lsit is the php file to render
        'dataProvider'=>$dataProvider,
        'summaryText'=>'',
        ));
    ?>
</div>
