<?php if(isset ($this->show_header) && $this->show_header==true) { ?>
    <div class="header_news_by_category header">
        <?php echo CHtml::link($this->categoryModel->name, $this->categoryModel->url, array('class' => " headerColor")); ?>
    </div>
<?php }?>

<?php 
if(isset ($this->show_sub_header) && $this->show_sub_header==true) { ?>
    <div class="header_news_by_category header">
            <h1><?php echo CHtml::link($this->categoryModel->name, $this->categoryModel->url, array('class' => "headerColor")); ?></h1>
<!--            --><?php //echo CHtml::link(Yii::t('app',"Add"), Yii::app()->createUrl('item/index', array('code' => 'catalog','category_id' => $this->categoryModel->id)), array('class' => 'tp-btn pull-right')); ?>
<!--        <div class="">-->
<!--                <hr>-->
<!--        </div>-->
    </div>

<?php }?>



<!--<div class="row">-->

<?php
    $this->widget('bootstrap.widgets.TbListView', array(
                'dataProvider' => $dataProvider,
                'itemView' => $this->itemView,
                'summaryText' => '',
                'pagerCssClass' => "pagination",
                'htmlOptions' => array('class' => 'grid_block'),
//                'htmlOptions' => array('class' => ''),
                'template'=>"{sorter}\n{items}\n{pager}{summary} ",
                'sorterCssClass'=>'auto_sorter',
                'sortableAttributes'=>$this->sortableAttributes,
                'pager' => array('header' => '',
                    'maxButtonCount' => $this->count,
                    'cssFile' => false,
                    'htmlOptions' => array('class' => 'pagination pull-right'),
                    'prevPageLabel' => '<i class="fa fa-chevron-left"></i>',
                    'nextPageLabel' => '<i class="fa fa-chevron-right"></i>',
                    'firstPageLabel' => Yii::t('app', '$LNG_FIRST'),
                    'lastPageLabel' => Yii::t('app', '$LNG_LAST'),
                ),
                'enableHistory' => true,
                'ajaxUpdate' => false,
            ));
        
        ?>
<!--</div>-->

<div class="clearfix"></div>


