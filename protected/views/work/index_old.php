<?php
$this->breadcrumbs = array_merge(
    $this->breadcrumbs, $modelCategory->getBreadcrumbs(true)
);
$this->is_inner_breadcrumb = false;
?>

    <div class="row">
        <div class="level2_cont_inner client-item  default">
            <div class="col-sm-3 level2_cont_left " style="
            border-right: 1px solid #DDDDDD;
            position: relative;
            left: 1px;">
                <div class="">
                    <?php $this->renderPartial('_search', array('model' => $model)); ?>
                </div>
            </div>

            <div class="col-sm-9 border-left level2_cont_right client-details">
                <h1 class="categoryHeader"><?php echo $modelCategory->name; ?></h1>

                <?php
                $sub_categories = $modelCategory->enabled_for_announcement()->children;
                if (isset($sub_categories) && count($sub_categories) > 0) {
                    ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <?php
                            $this->widget('application.widgets.category.CategorySubMenuWidget', array(
                                'category_id' => $modelCategory->id,
                                'itemCssClass' => 'col-sm-6 col-md-4',
                                'wrapperCssClass' => 'row sub_categories horizontal',
                            ));
                            ?>
                        </div>
                    </div>
                <?php } ?>

                <!--        <div class="row box_header_index">-->
                <!--            <div class="pull-right">-->
                <!--                --><?php //echo CHtml::link(Yii::t('app',"Add Rezume"), Yii::app()->createUrl('//catalog/generalCreate',array('category_id'=>116)), array('class' => 'tp-btn')); ?>
                <!--                --><?php //echo CHtml::link(Yii::t('app',"Add Vakansiya"), Yii::app()->createUrl('//catalog/generalCreate',array('category_id'=>117)), array('class' => 'tp-btn')); ?>
                <!--            </div>-->
                <!--        </div>-->

                <div class="row">
                    <!--            --><?php //$this->renderPartial('_search');  ?>
                    <?php $this->renderPartial('_professions'); ?>

                    <div class="">
                        <div class="dynamic_pages">

                            <?php
                            $this->widget('bootstrap.widgets.BootGridView', array(
                                'id' => 'work-grid',
                                'type' => 'striped condensed',
                                'dataProvider' => $model->search(),
                                'hideHeader' => true,
                                'htmlOptions' => array('class' => 'table-tp red_links'),
                                'summaryText' => false,
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
                                'selectionChanged' => "function(id){window.location='" . Yii::app()->urlManager->createUrl('//catalog/view', array('id' => '')) . "' + $.fn.yiiGridView.getSelection(id);}",
                                'columns' => array(
                                    array(
                                        'name' => 'date_added',
                                        'value' => 'date("d/m/Y", strtotime($data->material->date_added))',
                                        'filter' => false,
                                        'type' => 'raw',
                                        'htmlOptions' => array('style' => 'width:80px;', 'class' => "hidden-xs hidden-md"),
                                    ),

                                    array(
                                        'name' => 'type',
                                        'value' => 'Yii::t("app",$data->material->getType())',
                                        'filter' => false,
                                        'type' => 'raw',
                                        'htmlOptions' => array('style' => 'width:80px;', 'class' => "hidden-xs hidden-md"),
                                    ),

                                    array(
                                        'name' => 'profession_id',
                                        'value' => 'CHtml::link($data->material->getMixedProfessionName(), Yii::app()->createUrl("//work/index", array("profession_id" => $data->profession_id)))',
                                        'filter' => false,
                                        'type' => 'raw',
                                        'htmlOptions' => array('style' => 'width:80px;', 'class' => ""),
                                    ),

                                    array(
                                        'name' => 'title',
                                        'value' => 'CHtml::link(Yii::app()->controller->truncate($data->material->description, 10, 300), $data->material->url, array("alt" => $title,"class"=>"view"))',
                                        'type' => 'raw',
                                        'htmlOptions' => array('style' => 'max-width:350px;', 'class' => ""),
                                        'filter' => false,
                                    ),
//                                     array(
//                                        'name' => 'automodel.name',
//                                        'value' => '$data->getMixedAutoModelModel()->name',
//                                        'filter' => false,
//                                    ),
//                                     array(
//                                        'name' => 'year',
//                                        'value' => '$data->year',
//                                        'type'=>'raw',
//                                        'htmlOptions'=>array('style'=>'width:50px;','class'=>""),
//                                    ),
//                                     array(
//                                        'name' => 'price',
//                                        'value' => '$data->price',
//                                        'type'=>'raw',
//                                        'htmlOptions'=>array('style'=>'width:50px;','class'=>""),
//                                    ),
//                                   
//                                    array(
//                                        'name' => 'descriptions.description',
//                                        'value' => 'CHtml::link(Yii::app()->controller->truncate($data->getMixedDescriptionModel()->description,12,200), Yii::app()->createUrl("//auto/view",array("id"=>$data->id)))',
//                                        'type'=>'raw',
//                                        'htmlOptions'=>array('style'=>'width:150px;','class'=>""),
//                                    ),


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
        </div>
    </div>

<?php

Yii::app()->clientScript->registerScript('sssclick', "
        $(document).delegate('.items tbody tr','click',function(){
                window.location.href=$(this).find('.view').attr('href');
        });
     
    ");


?>