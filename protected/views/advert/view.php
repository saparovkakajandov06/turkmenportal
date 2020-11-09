<?php
$categoryName = '';
$title = $model->getTitle();
$lang_code = Yii::app()->language;


$url = $model->getUrl();
//$img_path = $model->getThumbPath(300, 335, 'w');
$modelCategory = $model->category;
//$this->subCategoryModel = $modelCategory;

if (isset($modelCategory)) {
    $this->breadcrumbs = array_merge(
        $this->breadcrumbs, $modelCategory->getBreadcrumbs(true)
    );
    $categoryName = " | " . $modelCategory->name;
}

$this->pageTitle = $title . $categoryName;
$this->meta_description = $model->getDescription();
$this->enable_mobile_banner_vtop2 = true;
?>


<div class="row">
    <?php if (!$this->isMobile()) { ?>
        <div class="col-sm-3 hidden-xs">
            <?php $this->renderPartial('//layouts/common/column2_left'); ?>
        </div>
    <?php } ?>

    <div class="col-sm-9 col-xs-12 border-left level2_cont_right">

        <h1 class="blog_header"> <?php echo $title; ?></h1>

        <div class="article_stats">
            <time class="article_header_date" itemprop="dateCreated"
                  datetime="<?php echo $this->dateToW3C($model->date_added); ?>"><?php echo $this->renderDateTime($model->date_added); ?></time>
            <div class="post-item__comments"><i
                    class="fa fa-comment"></i><span> <?php echo $model->getCommentCount(); ?> </span></div>
            <div class="post-item__views"><i class="fa fa-eye"></i><span><?php echo $model->views; ?></span>
            </div>
        </div>



        <div class="row">
            <div class="slider_wrapper">
                <div class="col-md-5 col-xs-12" style="display: inline-block">

<!--                    <span class="media-object pull-left">-->
                        <?php
                        $documents=$model->documents;
                        if(isset($documents) && count($documents)>0){
                            $this->renderPartial('//documents/_jssor_slider_mini', array('documents' => $documents));
                        }
                        ?>

<!--                        --><?php //echo CHtml::link(CHtml::image($img_path, $title), $model->getUrl(), array('class' => "thumb")); ?>
<!--                    </span>-->
                </div>

                <div class="col-md-7 col-xs-12">
                    <?php if (isset($model->address) && strlen(trim($model->address)) > 2) { ?>
                            <div class="place-info row">
                                <div class="place-info_label">
                                    <?php echo $model->getAttributeLabel('address') . ": "; ?>
                                </div>
                                <div class="place-info_labeled"> <b> <?php echo $model->address; ?></b> </div>
                            </div>
                    <?php } ?>



                    <?php if (isset($model->phone) && strlen(trim($model->phone)) > 2) { ?>
                        <div class="place-info row">
                                <div class="place-info_label">
                                        <?php echo $model->getAttributeLabel('phone') . ": "; ?>
                                </div>
                                <div class="place-info_labeled"> <b><?php echo $model->phone; ?></b></div>
                        </div>
                    <?php } ?>


                     <?php if (isset($model->mail) && strlen(trim($model->mail)) > 2) { ?>
                        <div class="place-info row">
                                <div class="place-info_label">
                                        <?php echo $model->getAttributeLabel('mail') . ": "; ?>
                                </div>
                                <div class="place-info_labeled"> <b><?php echo $model->mail; ?></b></div>
                        </div>
                    <?php } ?>

                     <?php if (isset($model->price) && strlen(trim($model->price)) > 2) { ?>
                        <div class="place-info row">
                                <div class="place-info_label">
                                        <?php echo $model->getAttributeLabel('price') . ": "; ?>
                                </div>
                                <div class="place-info_labeled"> <b><?php echo $model->price; ?></b></div>
                        </div>
                    <?php } ?>


                     <?php if (isset($model->web) && strlen(trim($model->web)) > 2) { ?>
                        <div class="place-info row">
                                <div class="place-info_label">
                                        <?php echo $model->getAttributeLabel('web') . ": "; ?>
                                </div>
                                <div class="place-info_labeled"> <b><?php echo $model->web; ?></b></div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>


        <div class="row" style="margin-top: 15px">
            <div class="col-md-12">
                <?php
                $content=$model->getDescription();
                echo nl2br($content);
                ?>
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
        $this->renderPartial('//comments/add_comment', array('related_relation' => 'catalogs', 'related_relation_id' => $model->getPrimaryKey()));
        ?>

        <div class="comments__head"><?php echo Yii::t('app', 'Related news'); ?></div>
        <div class="row">
            <?php
            $model->category_id=$modelCategory->id;
            $model->except=array($model->id);

            $this->widget('bootstrap.widgets.BootListView', array(
                'dataProvider' => $model->searchForCategory(6, false),
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




