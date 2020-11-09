<?php if(isset ($this->show_header) && $this->show_header==true) { ?>
    <div class="row box_header_index">
        <?php echo CHtml::link($this->categoryModel->getName(), Yii::app()->createUrl('//catalog/category/',array('category_id'=>$this->categoryModel->id)), array('class' => "mini headerColor")); ?>
    </div>
<?php }?>

<?php 
if(isset ($this->show_sub_header) && $this->show_sub_header==true) { ?>
    <div class="row sub_header_wrapper">
        <div class="col-md-10">
            <?php echo CHtml::link($this->categoryModel->getName(), Yii::app()->createUrl('//catalog/category', array('category_id' => $this->categoryModel->id)), array('class' => "subHeaderColor")); ?>
            <?php echo CHtml::link(Yii::t('app',"Add"), Yii::app()->createUrl('//catalog/generalCreate', array('category_id' => $this->categoryModel->id)), array('class' => 'tp-btn')); ?>
        </div>
    </div>
<?php }?>



    <!--<ul class="entries">-->
        <?php
        if(isset ($this->is_tableview) && $this->is_tableview==true){
            
//           $this->render('_catalog_mini_search',array(
//                    'model'=>$this->catalogModel,
//            )); 

            Yii::app()->clientScript->registerScript('search', "
                $('.search-form-mini form').submit(function(){
                    $.fn.yiiGridView.update('catalog-grid', {
                        data: $(this).serialize()
                    });
                    return false;
                });
            ");
            
            Yii::app()->controller->widget('bootstrap.widgets.BootGridView', array(
                'id' => 'catalog-grid',
                'type' => 'striped  condensed',
                'dataProvider' => $dataProvider,
                'hideHeader'=>true,
                'htmlOptions' => array('class' => 'table-tp red_links'),
                'summaryText' =>false,
                'pagerCssClass' => "pagination",
                'pager' => array('header' => '',
//                    'maxButtonCount' => $this->maxButtonCount,
                    'cssFile' => false,
                    'htmlOptions' => array('class' => 'pagination pull-right'),
                    'prevPageLabel' => '<i class="fa fa-chevron-left"></i>',
                    'nextPageLabel' => '<i class="fa fa-chevron-right"></i>',
                    'firstPageLabel' => Yii::t('app', '$LNG_FIRST'),
                    'lastPageLabel' => Yii::t('app', '$LNG_LAST'),
                ),
                'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl('//catalog/view', array('id'=>'')) . "' + $.fn.yiiGridView.getSelection(id);}",
                'columns' => array(
                    array(
                        'name' => 'documents.name',
                        'value' => 'CHtml::link(CHtml::image($data->getThumbPath(50,50)),Yii::app()->createUrl("//catalog/view",array("id"=>$data->id)))',
                        'type'=>'raw',
                        'htmlOptions' => array('style' => 'width:60px; padding-right:5px;')
                    ),
                    array(
                        'name' => 'title',
                        'value' => 'CHtml::link($data->getTitle(),Yii::app()->createUrl("//catalog/view",array("id"=>$data->id)))',
                        'type'=>'raw',
                        'htmlOptions' => array('style' => 'width:130px;')
                    ),
//                    array(
//                        'name' => 'description',
//                        'value' => '$data->getMixedDescriptionModel()->description',
//                        'type'=>'raw',
//                        'htmlOptions' => array('style' => 'width:130px;')
//                    ),
                   
                    array(
                        'name' => 'address',
                        'value' => '$data->address',
                        'type'=>'raw',
                        'htmlOptions' => array('style' => 'width:130px;')
                    ),
                     array(
                        'name' => 'phone',
                        'value' => '$data->phone',
                        'type'=>'raw',
                        'htmlOptions' => array('style' => 'width:130px;')
                    ),
//                    array(
//                        'name' => 'web',
//                        'value' => '$data->web',
//                        'type'=>'raw',
//                        'htmlOptions' => array('style' => 'width:130px;')
//                    ),
//                    'model_id',
//                    'region_id',
//                    'price',
//                    'date_added',
                ),
            ));
            
        }elseif(isset ($this->is_only_listview) && $this->is_only_listview==true){
            $this->widget('bootstrap.widgets.BootListView', array(
                'dataProvider' => $dataProvider,
                'itemView' => '_listview_only_catalog',
                'summaryText' => '',
                'pagerCssClass' => "pagination",
                'htmlOptions' => array('class' => 'grid_block'),
                'pager' => array('header' => '',
                    'maxButtonCount' => $this->count,
                    'cssFile' => false,
                    'htmlOptions' => array('class' => 'pagination pull-right'),
                    'prevPageLabel' => '<i class="fa fa-chevron-left"></i>',
                    'nextPageLabel' => '<i class="fa fa-chevron-right"></i>',
                    'firstPageLabel' => Yii::t('app', '$LNG_FIRST'),
                    'lastPageLabel' => Yii::t('app', '$LNG_LAST'),
                ),
            ));
        }else{
            $this->widget('bootstrap.widgets.BootListView', array(
                'dataProvider' => $dataProvider,
                'itemView' => '_listview_catalog',
                'summaryText' => '',
                'pagerCssClass' => "pagination",
                'htmlOptions' => array('class' => 'grid_block'),
                'pager' => array('header' => '',
                    'maxButtonCount' => $this->count,
                    'cssFile' => false,
                    'htmlOptions' => array('class' => 'pagination pull-right'),
                    'prevPageLabel' => '<i class="fa fa-chevron-left"></i>',
                    'nextPageLabel' => '<i class="fa fa-chevron-right"></i>',
                    'firstPageLabel' => Yii::t('app', '$LNG_FIRST'),
                    'lastPageLabel' => Yii::t('app', '$LNG_LAST'),
                ),
            ));
        }
        ?>
    <!--</ul>-->

    
<div class="clearfix"></div>

<?php if(isset ($this->show_all) && $this->show_all==true) {?>
    <div class="show_all_wrapper">
        <a class="show_all_big" href="<?php echo Yii::app()->createUrl('//catalog/category',array('category_id'=>$this->categoryModel->id))?>" >
            <?php echo Yii::t('app', 'SHOW ALL')?>
            <i class="fa fa-chevron-down" ></i>
        </a>
    </div>
<?php }?>