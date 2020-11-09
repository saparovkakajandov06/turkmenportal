<div class="row">
    <div class="compositions">

        <?php

        if (!Yii::app()->controller->isMobile()) {
            $itemView = '//tiles/_tilesview';
            $this->widget('bootstrap.widgets.BootListView',
                array ('itemView' => $itemView,//_lsit is the php file to render
                    'dataProvider' => $dataProvider,
                    'summaryText' => '',
                ));
        } else {
            $itemView = '//tiles/_tilesview_mini';
            ?>
            <div class="col-xs-12">
                <?php
                $this->widget('bootstrap.widgets.BootListView',
                    array ('itemView' => $itemView,//_lsit is the php file to render
                        'dataProvider' => $dataProvider,
                        'summaryText' => '',
                    ));
                ?>
            </div>
            <?php
        }
        ?>
    </div>
</div>