<?php if(isset($this->headerText) && strlen(trim($this->headerText))){ ?>
    <div class="<?php echo $this->headerCssClass; ?>"><?php echo $this->headerText; ?></div>
<?php } ?>

<div class="mobile_block row" >
    
    <?php
    $this->widget('bootstrap.widgets.BootListView', array(
                'dataProvider' => $dataProvider,
                'itemView' => $this->itemView,
                'summaryText' => '',
                'emptyText' => '',
                'pagerCssClass' => "pagination",
                'htmlOptions' => array('class' => ''),
                'template'=>"{sorter}\n{items}\n{pager}{summary} ",
//                'sorterCssClass'=>'auto_sorter',
//                'sortableAttributes'=>$this->sortableAttributes,                
//                'pager' => array('header' => '',
//                    'maxButtonCount' => $this->count,
//                    'cssFile' => false,
//                    'htmlOptions' => array('class' => 'pagination pull-right'),
//                    'prevPageLabel' => '<i class="fa fa-chevron-left"></i>',
//                    'nextPageLabel' => '<i class="fa fa-chevron-right"></i>',
//                    'firstPageLabel' => Yii::t('app', '$LNG_FIRST'),
//                    'lastPageLabel' => Yii::t('app', '$LNG_LAST'),
//                ),
            ));
        
    ?>
   
</div>

