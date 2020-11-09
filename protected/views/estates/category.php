<div class="row">
    
    
        <div class="col-sm-3">
                <?php
                     $sub_categories = $modelCategory->children;
                     if (isset($sub_categories) && count($sub_categories) > 0) {
                            $parent_name=$modelCategory->getMixedDescriptionModel()->name;
                            $this->breadcrumbs = array(
                                $parent_name,
                            );
                            $this->renderPartial('//estates/_sub_categories', array('modelCategory' => $modelCategory));
                            $dataProvider=$modelEstates->searchForCategory(null, 0);
                     }else{
                             $parent_name=$modelCategory->parent->getMixedDescriptionModel()->name;
                             $this->breadcrumbs = array(
                                $parent_name => array('//estates/category'),
                                $modelCategory->getMixedDescriptionModel()->name,
                             );
                             $this->renderPartial('//estates/_sub_categories', array('modelCategory' => $modelCategory->parent));
                             $dataProvider=$modelEstates->searchForCategory($modelCategory->id, 0);
                     }
                ?>
        </div>
    
        <div class="col-sm-9">
            <div class="row box_header_index">
                <h1 class="categoryHeader"><?php echo $parent_name ?></h1>
            </div>
            <div class="row">
                    <div class="search-form auto" >
                        <?php $this->renderPartial('_search',array('model'=>$modelEstates)); ?>
                    </div>
            
                    <?php 
                        Yii::app()->clientScript->registerScript('search', "
                            $('.search-button').click(function(){
                                $('.search-form').toggle();
                                return false;
                            });
                            $('.search-form form').submit(function(){
                                $.fn.yiiGridView.update('estates-grid', {
                                    data: $(this).serialize()
                                });
                                return false;
                            });
                        ");
                        
                    ?>
            </div>

            <div class="row">
                <div class="dynamic_pages">
                     <?php
                        $this->widget('bootstrap.widgets.BootGridView', array(
                                'id' => 'estates-grid',
                                'type' => 'striped  condensed',
                                'dataProvider' => $dataProvider,
                                'hideHeader'=>true,
                                'htmlOptions' => array('class' => 'table-tp red_links'),
                                'summaryText' => false,
                                'pagerCssClass' => "pagination",
                                'pager' => array('header' => '',
                                    'maxButtonCount' => $this->maxButtonCount,
                                    'cssFile' => false,
                                    'htmlOptions' => array('class' => 'pagination pull-right'),
                                    'prevPageLabel' => '<i class="fa fa-chevron-left"></i>',
                                    'nextPageLabel' => '<i class="fa fa-chevron-right"></i>',
                                    'firstPageLabel' => Yii::t('app', '$LNG_FIRST'),
                                    'lastPageLabel' => Yii::t('app', '$LNG_LAST'),
                                ),
//                                'beforeAjaxUpdate' => 'js:function(id) { $(".search-form").append(\'<div class="loading"></div>\');}',
                                'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl('//estates/view', array('id'=>'')) . "' + $.fn.yiiGridView.getSelection(id);}",
                                'columns' => array(
                                    array(
                                        'name'=>'date_added',
                                        'value' => 'date("d/m/Y", strtotime($data->date_added))',
                                        'filter'=>false,
                                        'type'=>'raw',
                                        'htmlOptions'=>array('style'=>'width:90px;','class'=>"hidden-xs hidden-md"),
                                    ),
                                    array(
                                        'name' => 'documents.name',
                                        'value' => 'CHtml::link(CHtml::image($data->getThumbPath(50,50,"auto")),Yii::app()->createUrl("//estates/view",array("id"=>$data->id)))',
                                        'type'=>'raw',
                                        'filter' => false,
                                        'htmlOptions' => array('style' => 'width:100px; padding-right:10px;')
                                    ),
                                    array(
                                        'name' => 'category.name',
                                        'value' => 'CHtml::link($data->category->getMixedDescriptionModel()->name,Yii::app()->createUrl("//estates/category",array("category_id"=>$data->category_id)))',
                                        'type'=>'raw',
                                        'htmlOptions' => array('style' => 'width:120px; padding-right:10px;'),
                                        'filter' => false,
                                    ),
                                    array(
                                        'name' => 'room',
                                        'value' => '$data->room',
                                        'type'=>'raw',
                                        'htmlOptions' => array('style' => 'width:30px; padding-right:10px;'),
                                        'filter' => false,
                                    ),
                                    
                                    array(
                                        'name' => 'price',
                                        'value' => 'Yii::app()->controller->price_to_dollar($data->price)',
                                        'type'=>'raw',
                                        'htmlOptions' => array('style' => 'width:30px; padding-right:10px;'),
                                        'filter' => false,
                                    ),
                                     array(
                                        'name' => 'descriptions.description',
                                        'value' => 'CHtml::link(Yii::app()->controller->truncate($data->getMixedDescriptionModel()->description,15,250), Yii::app()->createUrl("//estates/view",array("id"=>$data->id)))',
                                        'type'=>'raw',
                                        'htmlOptions'=>array('style'=>'width:200px;','class'=>""),
                                    ),
//                                    array(
//                                        'class' => 'bootstrap.widgets.BootButtonColumn',
//                                        'template' => '{view}',
//                                        'htmlOptions' => array('style' => 'width: 85px; text-align:right;'),
//                                    ),
                                ),
                            ));
                    ?>
                    
                </div>
            </div>
        </div>
</div>


