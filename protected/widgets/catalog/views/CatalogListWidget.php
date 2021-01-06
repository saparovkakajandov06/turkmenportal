
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
<div class="more-wrapper" style="margin-bottom: 20px; ">
    <?php
    if (!isset($this->category_code)){
        $code = $this->parent_category_code;
    } else {
        $code = $this->category_code;
    }
    $this->widget('application.widgets.category.CategoryMoreWidget', array(
        'maxSubCatCount' => 5,
        'category_code' => $code,
        'categoy_index_url' => '//blog',
        'view' => 'CategoryMoreWidget',
    ));
    ?>
</div>
