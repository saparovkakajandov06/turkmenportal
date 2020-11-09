<div class="row">
    
    
        <div class="col-sm-3">
                <?php
                     $sub_categories = $modelCategory->children;
                     
                     if (isset($sub_categories) && count($sub_categories) > 0) {
                            $this->breadcrumbs = array(
                                $modelCategory->getMixedDescriptionModel()->name,
                            );
                            $this->renderPartial('//category/_sub_categories', array('modelCategory' => $modelCategory));
                            $dataProvider=$modelCatalog->searchForCategory(null, 0,false,'fotoreport');
                     }else{
                             $this->breadcrumbs = array(
//                                $modelCategory->parent->getMixedDescriptionModel()->name => array('//catalog/category'),
                                $modelCategory->getMixedDescriptionModel()->name,
                             );
                             $this->renderPartial('//category/_sub_categories', array('modelCategory' => $modelCategory->parent));
                             $dataProvider=$modelCatalog->searchForCategory($modelCategory->id, 0);
                     }
                ?>
        </div>
    
    
    
        <div class="col-sm-9">
            <div class="row">
                    <?php //$this->renderPartial('_search',array('model'=>$modelAuto,)); ?>
            </div>
            <div class="row">
                <div class="dynamic_pages">
                     <?php
                        $this->widget('bootstrap.widgets.BootListView', array(
                            'dataProvider' => $dataProvider,
                            'itemView' => '_listview_fotoreport_blocks',
                            'summaryText' => '',
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
                        ));
                    ?>
                </div>
            </div>
        </div>
</div>