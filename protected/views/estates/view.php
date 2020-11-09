<?php
//$modelCategory = $model->getMixedCategoryModel();
//$this->breadcrumbs = array(
//    $modelCategory->parent->getMixedDescriptionModel()->name => array('//estates/category'),
//    $modelCategory->getMixedDescriptionModel()->name,
//);
//
//  $this->pageTitle=$model->getMixedDescriptionModel()->description; 
?>



<?php
$title = $model->title;

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
    <div class="col-sm-12">

        <h1 class="blog_header"> <?php echo $title; ?></h1>
        <div class="article_stats">
            <time class="article_header_date" itemprop="dateCreated"
                  datetime="<?php echo $this->dateToW3C($model->date_added); ?>"><?php echo $this->renderDateTime($model->date_added); ?></time>
            <div class="post-item__comments"><i
                    class="fa fa-comment"></i><span> <?php echo $model->getCommentCount(); ?> </span></div>
            <div class="post-item__views"><i class="fa fa-eye"></i><span><?php echo $model->views; ?></span></div>
            <!--                <div class="post-item__comments"><i-->
            <!--                        class="fa fa-thumbs-up"></i><span>-->
            <?php //echo isset($model->likes) ? $model->likes : 0; ?><!--</span>-->
            <!--                </div>-->
            <!--                <div class="post-item__comments"><i-->
            <!--                        class="fa fa-thumbs-down"></i><span>-->
            <?php //echo isset($model->dislikes) ? $model->dislikes : 0; ?><!--</span>-->
            <!--                </div>-->
        </div>


        <?php
        $documents=$model->documents;
        if(isset($documents) && is_array($documents) && count($documents)>0){ ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="slider_wrapper">
                        <?php
                        $this->renderPartial('//documents/_jssor_slider', array('documents' => $documents));
                        ?>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="row">
            <div class="catalog-detail">

                <div class="col-md-5 sm-pull-right">
                    <div class="general_detail">
                        <div class="header">
                            <span><?php echo Yii::t('app', 'owner'); ?></span>
                        </div>

                        <?php
                        $attributes = array(
                            array(
                                'label' => $model->getAttributeLabel('owner'),
                                'value' => $model->getOwnerFullname(),
                                'visible' => (isset($model->owner) || isset($model->create_username)),
                            ),

                            array(
                                'label' => $model->getAttributeLabel('phone'),
                                'value' => $model->phone,
                                'visible' => (isset($model->phone) && strlen(trim($model->phone)) > 0),

                            ),
                            array(
                                'label' => $model->getAttributeLabel('mail'),
                                'value' => $model->mail,
                                'visible' => (isset($model->mail) && strlen(trim($model->mail)) > 0),
                            ),
                            array(
                                'label' => $model->getAttributeLabel('web'),
                                'value' => $model->web,
                                'type' => 'raw',
                                'visible' => (isset($model->web) && strlen(trim($model->web)) > 0),
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

                <div class="col-md-7">
                    <p class="title">
                        <?php
                        echo $model->getFulltitle();
                        ?>
                    </p>

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


        <?php $this->beginWidget('DNofollowWidget'); ?>
        <?php
        $this->renderPartial('//comments/add_comment', array('related_relation' => 'estates', 'related_relation_id' => $model->getPrimaryKey()));
        ?>

        <div class="comments__head"><?php echo Yii::t('app', 'Related'); ?></div>
        <div class="row">
            <?php
            $estatesModel=new Estates();
            $estatesModel->unsetAttributes();
            $estatesModel->category_id = $modelCategory->id;
            $estatesModel->except = array($model->id);
            $this->widget('bootstrap.widgets.BootListView', array(
                'dataProvider' => $estatesModel->searchForCategory(6, false),
                'itemView' => '_related_listview',
                'summaryText' => '',
                'emptyText' => '',
            ));
            ?>
        </div>
        <?php $this->endWidget(); ?>

    </div>
</div>
