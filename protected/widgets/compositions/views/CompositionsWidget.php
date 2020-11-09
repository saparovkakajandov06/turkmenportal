<div class="row">
    <div class="compositions">

        <?php

        if ($this->viewType == 'list') {
            $this->widget('bootstrap.widgets.BootListView',
                array('itemView' => '_listview_composition',//_lsit is the php file to render
                    //        'id'=>'composition-carousel',//id of Carousel
                    //        'slide'=>array(true,10000),//to slide after 2seconds
                    'dataProvider' => $dataProvider,
                    'pager' => '',
                    'summaryText' => '',
                    //        'coloumCount'=>$this->columnCount,//no of items to shown in slider
                ));
        }


        if ($this->viewType == 'tile') {
            if (!Yii::app()->controller->isMobile()) {
                $itemView = '//tiles/_tilesview';
                $this->widget('bootstrap.widgets.BootListView',
                    array('itemView' => $itemView,//_lsit is the php file to render
                        'dataProvider' => $dataProvider,
                        'summaryText' => '',
                    ));
            } else {
                $itemView = '//tiles/_tilesview_mini';
                ?>
                <div class="col-xs-12">
                    <?php
                    $this->widget('bootstrap.widgets.BootListView',
                        array('itemView' => $itemView,//_lsit is the php file to render
                            'dataProvider' => $dataProvider,
                            'summaryText' => '',
                        ));
                    ?>
                </div>
                <?php

            }
        }

        //    if ($this->viewType == 'carousel') {
        //        $this->widget('bootstrap.widgets.BootSlider',
        //            array('itemView' => '//list/_listview_composition',//_lsit is the php file to render
        //                'id' => 'composition-carousel',//id of Carousel
        //                'slide' => array(true, 10000),//to slide after 2seconds
        //                'dataProvider' => $dataProvider,
        //                'coloumCount' => $this->count,//no of items to shown in slider
        //            ));
        //    }


        ?>
    </div>
</div>