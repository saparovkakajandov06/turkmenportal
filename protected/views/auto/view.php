<?php
//    $modelCategory = $model->getMixedCategoryModel();
//    if(isset($modelCategory) && isset($modelCategory->parent)){
//        $this->breadcrumbs[$modelCategory->parent->getMixedDescriptionModel()->name]= array('//auto/category', 'category_id' => $modelCategory->parent_id);
//        $this->breadcrumbs[]=$modelCategory->getMixedDescriptionModel()->name;
//    }
//    $this->pageTitle=$model->getMixedDescriptionModel()->description; 
?>

<?php
$title = $model->getTitle();

$modelCategory = $model->category;
if (isset($modelCategory)) {
    $this->breadcrumbs = array_merge(
        $this->breadcrumbs,
        $modelCategory->getBreadcrumbs(true)
    );
}
$this->enable_mobile_banner_vtop2 = true;
?>


<div class="row">
    <div class="col-xs-12">
        <?php
        $this->widget('application.widgets.banners.BannersWidget', array(
            'type' => 'auto_view_mobile_top',
            'outer_css_id' => 'auto_view_mobile_top',
        ));
        ?>
    </div>

    <div class="col-sm-12" itemscope="" itemtype="http://schema.org/Product">
        <h1 class="blog_header" itemprop="name"> <?php echo $title; ?></h1>
        <div class="article_stats">
            <time class="article_header_date" itemprop="releaseDate"
                  content="<?php echo $this->dateToW3C($model->date_added); ?>"><?php echo $this->renderDateTime($model->date_added); ?></time>
            <div class="post-item__comments"><i
                        class="fa fa-comment"></i><span> <?php echo $model->getCommentCount(); ?> </span></div>
            <div class="post-item__views"><i class="fa fa-eye"></i><span><?php echo $model->views; ?></span></div>
            <!--                <div class="post-item__comments"><i class="fa fa-thumbs-up"></i><span>-->
            <?php //echo isset($model->likes) ? $model->likes : 0; ?><!--</span></div>-->
            <!--                <div class="post-item__comments"><i class="fa fa-thumbs-down"></i><span>-->
            <?php //echo isset($model->dislikes) ? $model->dislikes : 0; ?><!--</span></div>-->
        </div>

        <?php
        $documents = $model->documents;
        if (isset($documents) && is_array($documents) && count($documents) > 0) { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="slider_wrapper">
                        <?php
                        $this->renderPartial('//documents/_jssor_slider', array('documents' => $documents, 'title' => $title));
                        ?>
                    </div>
                </div>
            </div>
        <?php } ?>


        <div class="row">
            <div class="catalog-detail" itemscope="" itemprop="brand" itemtype="http://schema.org/Organization">
                <div class="col-md-5 sm-pull-right">
                    <div class="general_detail" itemprop="brand" itemscope="" itemtype="http://schema.org/Organization">
                        <div class="header">
                            <span><?php echo Yii::t('app', 'owner'); ?></span>
                        </div>

                        <?php
                        $attributes = array(
                            array(
                                'label' => $model->getAttributeLabel('owner'),
                                'value' => $model->getOwnerFullname(),
                                'visible' => (strlen(trim($model->getOwnerFullname())) > 2),
                            ),

                            array(
                                'label' => $model->getAttributeLabel('phone'),
                                'value' => $model->phone,
                                'visible' => (isset($model->phone) && strlen(trim($model->phone)) > 2),

                            ),
                            array(
                                'label' => $model->getAttributeLabel('lineid'),
                                'value' => $model->lineid,
                                'visible' => (isset($model->lineid) && strlen(trim($model->lineid)) > 2),
                            ),
                            array(
                                'label' => $model->getAttributeLabel('region_id'),
                                'value' => isset($model->region) ? $model->region->getMixedName() : "",
                                'visible' => (isset($model->region) && strlen(trim($model->region_id)) > 2),
                            ),
                            array(
                                'label' => $model->getAttributeLabel('isCredit'),
                                'value' => (isset($model->isCredit) && $model->isCredit == 1) ? Yii::t('app', 'Yes') : Yii::t('app', 'No'),
                                'visible' => isset($model->isCredit),
                            ),
                            array(
                                'label' => $model->getAttributeLabel('mail'),
                                'value' => $model->mail,
                                'visible' => (isset($model->mail) && strlen(trim($model->mail)) > 2),
                            ),
                            array(
                                'label' => $model->getAttributeLabel('web'),
                                'value' => $model->web,
                                'type' => 'raw',
                                'visible' => (isset($model->web) && strlen(trim($model->web)) > 2),
                            ),
                        );

                        $this->widget('bootstrap.widgets.BootDetailView', array(
                                'data' => $model,
                                'attributes' => $attributes,
                                'tagName' => null,
                                'itemCssClass' => "item-param-g",
                                'itemTemplate' => "<div class=\"item-params c-1\"><dl class=\"{class}\"><dt class=\"item-param-g-title\">{label}</dt><dd class=\"item-param-g-value\">{value}</dd></dl></div>\n",
                            )
                        );
                        ?>
                    </div>
                </div>

                <div class="col-md-7 ">
                    <p class="title" itemprop="description">
                        <?php
                        echo $model->getFulltitle();
                        ?>
                    </p>


                    <p class="details" itemprop="description">
                        <?php
                        echo $model->getDetails(false);
                        ?>
                    </p>


                    <div class="options">
                        <?php
                        if (isset($model->other_options) && strlen(trim($model->other_options))) {
                            $model->other_options = unserialize($model->other_options);
                            echo CHtml::activeCheckBoxList($model, 'other_options', $model->getOtherOptions(), array('container' => 'ul', 'template' => "<li class=\"checkbox-inline\">{input}{label}</li>", "separator" => ""));
                        }
                        ?>
                    </div>


                    <?php if (isset($model->description)) { ?>
                        <div class="description-content" itemprop="description">
                            <p><?php echo nl2br($model->description); ?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="row">
            <?php
            $this->widget('application.widgets.banners.BannersWidget', array(
                'type' => 'bannerNesipetsin',
                'outer_css_class' => 'mobile-responsive col-sm-12',
            ));
            ?>
        </div>


        <!--noindex-->
        <?php $this->beginWidget('DNofollowWidget'); ?>
        <?php
        $this->renderPartial('//comments/add_comment', array('related_relation' => 'autos', 'related_relation_id' => $model->getPrimaryKey()));
        ?>

        <div class="comments__head"><?php echo Yii::t('app', 'Related'); ?></div>
        <div class="row">
            <?php
            $searchModel = new Auto();
            $searchModel->unsetAttributes();
            $searchModel->category_id = $modelCategory->id;
            $searchModel->model_id = $model->model_id;
            $searchModel->except = array($model->id);
            $this->widget('bootstrap.widgets.BootListView', array(
                'dataProvider' => $searchModel->searchForCategory($modelCategory->id, 5, false),
                'itemView' => '_related_listview',
                'summaryText' => '',
                'emptyText' => '',
            ));
            ?>
        </div>
        <?php $this->endWidget(); ?>
        <!--/noindex-->
    </div>
</div>


<?php
Yii::app()->clientScript->registerScript('view', ' 
        $(function() {
            checkCheckboxInputs();
        });
        
        function checkCheckboxInputs(){
            $(".checkbox-inline").each(function(){
                if($(this).find("input[type=checkbox]").is(":checked")){
                    $(this).prepend("<i class=\"fa fa-check\"/>");
                    $(this).addClass("active");
                }
                else{
                    $(this).prepend("<i class=\"fa fa-times\"/>");
                    $(this).removeClass("active");
                }
            });
        }
    ', CClientScript::POS_READY);
?>
