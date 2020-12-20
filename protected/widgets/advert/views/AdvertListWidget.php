
<div class="news_by_category" >
    
    <?php
    $this->widget('bootstrap.widgets.BootListView', array(
                'dataProvider' => $dataProvider,
                'itemView' => $this->itemView,
                'summaryText' => '',
                'emptyText' => '',
//                'pagerCssClass' => "pagination",
                'htmlOptions' => array('class' => ''),
//                'template'=>"{sorter}\n{items}\n{pager}{summary} ",
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
<div class="more-wrapper visible-xs" style="margin-bottom: 20px; ">
    <?php
    $this->widget('application.widgets.category.CategoryMoreWidget', array(
        'maxSubCatCount' => 5,
        'category_code' => $this->category_code,
        'categoy_index_url' => '//blog',
        'view' => 'CategoryMoreWidget',
    ));
    ?>
</div>
