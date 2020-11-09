<div class="row">


    <div class="col-sm-3">
        <?php
        $sub_categories = $modelCategory->children;

        if (isset($sub_categories) && count($sub_categories) > 0) {
            $this->breadcrumbs = array(
                $modelCategory->getMixedDescriptionModel()->name,
            );
            $this->renderPartial('//category/_sub_categories', array('modelCategory' => $modelCategory));
//                            $dataProvider=$modelCatalog->searchForCategory(null, 0);
        } else {
            $this->breadcrumbs = array(
//                                $modelCategory->parent->getMixedDescriptionModel()->name => array('//catalog/category'),
                $modelCategory->getMixedDescriptionModel()->name,
            );
            $this->renderPartial('//category/_sub_categories', array('modelCategory' => $modelCategory->parent));
            $dataProvider = $modelCatalog->searchForCategory($modelCategory->id, 0);
        }
        ?>
    </div>



    <div class="col-sm-9">
        <div class="row">
            <?php //$this->renderPartial('_search',array('model'=>$modelAuto,)); ?>
        </div>


        <div class="row">
            <div class="dynamic_pages">
                <?php if (isset($sub_categories) && count($sub_categories) > 0) { ?>
                   
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="row sub_header_wrapper">
                                    <div class="col-md-10">
                                        <a href="catalog.php?s=116&amp;c=work" class="subHeaderColor">Ищу работу</a>
                                    </div>

                                    <div class="col-md-2">
                                        <?php echo CHtml::link("+Add", Yii::app()->createUrl('//employees/generalCreate'), array('class' => 'tp-btn')); ?>
                                    </div>
                                </div>



                                <ul class="entries">
                                    <?php
                                    $this->widget('bootstrap.widgets.BootListView', array(
                                        'dataProvider' => $modelEmployees->searchForIndex(10),
                                        'itemView' => '_listview_employees',
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
                                </ul>
                            </div>

                            <div class="col-md-6">
                                <div class="row sub_header_wrapper">
                                    <div class="col-md-10">
                                        <a href="catalog.php?s=116&amp;c=work" class="subHeaderColor">Предлагаю работу</a>
                                    </div>
                                    <div class="col-md-2">
                                        <?php echo CHtml::link("+Add", Yii::app()->createUrl('//employers/generalCreate'), array('class' => 'tp-btn')); ?>
                                    </div>
                                </div>

                                <ul class="entries">
                                    <?php
                                    $this->widget('bootstrap.widgets.BootListView', array(
                                        'dataProvider' => $modelEmployers->searchForIndex(7),
                                        'itemView' => '_listview_employers',
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
                                </ul>
                            </div>
                        </div>
                    </div>


                    <?php
                } else {
                    $this->widget('bootstrap.widgets.BootGridView', array(
                        'id' => 'blog-grid',
                        'type' => 'striped bordered condensed',
                        'dataProvider' => $dataProvider,
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
                        'columns' => array(
                            array(
                                'name' => 'date_added',
                                'value' => 'date("d-m-Y", strtotime($data->date_added))',
                                'filter' => false,
                                'type' => 'raw',
                                'htmlOptions' => array('style' => 'width:90px;', 'class' => "hidden-tablet hidden-phone"),
                            ),
                            array(
                                'name' => 'documents.name',
                                'value' => '$data->getThumbAsGallery()',
                                'type' => 'raw',
                                'filter' => false,
                                'htmlOptions' => array('style' => 'width:100px; padding-right:10px;')
                            ),
                            array(
                                'name' => 'category.name',
                                'value' => 'CHtml::link($data->category->getMixedDescriptionModel()->name,Yii::app()->createUrl("//catalog/category",array("category_id"=>$data->category_id)))',
                                'type' => 'raw',
                                'filter' => false,
                            ),
                            array(
                                'name' => 'descriptions.title',
                                'value' => 'CHtml::link($data->getMixedDescriptionModel()->title, Yii::app()->createUrl("//catalog/view",array("id"=>$data->id)))',
                                'type' => 'raw',
                                'htmlOptions' => array('style' => 'width:35%;', 'class' => ""),
                            ),
                            array(
                                'class' => 'bootstrap.widgets.BootButtonColumn',
                                'template' => '{view}',
                                'htmlOptions' => array('style' => 'width: 85px; text-align:right;'),
                            ),
                        ),
                    ));
                }
                ?>
            </div>
        </div>
    </div>
</div>