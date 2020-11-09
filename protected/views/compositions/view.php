<?php
//    $modelCategory = $model->getMixedCategoryModel();
//    if(isset($modelCategory) && isset($modelCategory->parent)){
//        $this->breadcrumbs[$modelCategory->parent->getMixedDescriptionModel()->name]= array('//compositions/index');
//        $this->breadcrumbs[]=$modelCategory->getMixedDescriptionModel()->name;
//    }
$categoryName = '';
$title = $model->getTitle();
$lang_code = Yii::app()->language;

$modelCategory = $model->category;
$this->subCategoryModel = $modelCategory;
$imageBigPath = $img_path = $model->getThumbPath(300, 335, 'w');
$url = $model->getUrl();

if (isset($model->related_document)) {
    if ($model->related_document->resized_imagesize) {
        list($width_orig, $height_orig) = $model->related_document->resized_imagesize;
    }
    $imageBigPath = $model->related_document->getRealPath();
}

if (isset($modelCategory)) {
    $this->breadcrumbs = array_merge(
        $this->breadcrumbs, $modelCategory->getBreadcrumbs(true)
    );
    $categoryName = " | " . $modelCategory->name;
}


$this->pageTitle = $title . $categoryName;
$this->meta_description = $title;
//    $this->meta_keyword = $model->{tags . $lang_code}->toString();
$this->page_url = $url;
$this->page_image = Yii::app()->getBaseUrl(true) . $imageBigPath;
$this->is_inner_breadcrumb = true;
$this->translated = $model->translated;
$this->enable_mobile_banner_vtop2 = true;
?>


<div class="row">
    <div class="col-sm-3 col-xs-12">
        <?php $this->renderPartial('//layouts/common/column2_left'); ?>
    </div>


    <div class="col-sm-9 col-xs-12 border-left level2_cont_right">

        <?php $this->pageTitle = $model->getTitle(); ?>
        <h1 class="blog_header"><?php echo $model->getTitle(); ?></h1>
        <div class="article_stats">
            <time class="article_header_date" itemprop="dateCreated"
                  datetime="<?php echo $this->dateToW3C($model->date_added); ?>"><?php echo $this->renderDateTime($model->date_added); ?></time>
            <div class="post-item__comments"><i
                        class="fa fa-comment"></i><span> <?php echo $model->getCommentCount(); ?> </span></div>
            <div class="post-item__views"><i class="fa fa-eye"></i><span><?php echo $model->views; ?></span>
            </div>
        </div>


        <?php
        if ($model->hasRelatedVideo()) {
            $this->widget('application.widgets.videojs.VideoJs', array(
                'item_class' => 'col-sm-3 col-md-3',
                'document' => $model->related_document,
                'width' => '650',
            ));
        } elseif (isset($img_path) && strlen(trim($img_path)) > 0) { ?>
            <div class="main_image media-object responsive">
                    <span class="thumb">
            <?php echo CHtml::link(CHtml::image($img_path, $title, array('title' => $title, 'itemprop' => 'associatedMedia')), $imageBigPath, array('class' => 'fancybox', 'rel' => 'blog', 'data-fancybox' => 'blog', 'data-width' => $width_orig, 'data-height' => $height_orig,)); ?>
                    </span>
            </div>
        <?php } ?>

        <div class="article_text" itemprop="articleBody">
            <?php
            $date_added = new DateTime($model->date_added);
            $date_renew = new DateTime("2014-12-01");

            if ($date_added > $date_renew) {
                echo $model->getContent();
            } else {
                echo nl2br($model->getContent());
            }
            ?>
        </div>
        <?php if (isset($model->web) && strlen(trim($model->web)) > 0) { ?>
            <div class="web_address">
                <?php echo Yii::t('app', 'detailed') . ": " . 'http://' . $model->web; ?>
                <!--                    --><?php //echo Yii::t('app', 'detailed').": ".CHtml::link(Yii::t('app', 'source'),'http://'.$model->web,array('rel'=>'nofollow')); ?>
            </div>
        <?php } ?>

        <div class="social_panel">
            <div class="row">
                <div class="col-md-12 ">
                    <div class=" pull-left">
                        <?php
                        if (isset($model)) {
                            $this->widget('application.extensions.yii-yashare.YaShare', array(
                                'services' => 'vkontakte,twitter,facebook,gplus,odnoklassniki,moimir',
                                'title' => 'Поделиться в социальной сети:',
                            ));
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>


        <?php $this->beginWidget('DNofollowWidget'); ?>
        <?php
        $this->renderPartial('//comments/add_comment', array('related_relation' => 'compositions', 'related_relation_id' => $model->getPrimaryKey()));
        ?>

        <div class="comments__head"><?php echo Yii::t('app', 'Related Compositions'); ?></div>
        <div class="row">
            <?php
            $related_view = '_related_listview';
            if (Yii::app()->controller->isMobile())
                $related_view = '_related_listview_mobile';

            $this->widget('bootstrap.widgets.BootListView', array(
                'dataProvider' => $model->searchForCategory(5, false, array($model->id)),
                'itemView' => $related_view,
                'summaryText' => '',
                'emptyText' => '',
            ));
            ?>
        </div>

        <?php
        $this->widget('application.widgets.banners.BannersWidget', array(
            'type' => 'matched_content',
            'outer_css_id' => 'matched_content',
        ));
        ?>
        <?php $this->endWidget(); ?>

    </div>
</div>


<?php
Yii::app()->clientScript
    ->registerCssFile(Yii::app()->theme->baseUrl . '/css/fancybox/jquery.fancybox.min.css?v=0.1')
    ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/fancybox/jquery.fancybox.min.js', CClientScript::POS_END)
    //    ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jssor/jssor.photoswipe.settings.js', CClientScript::POS_END)
    ->registerScript('fancybox_wrapper', '
            $(\'.article_text img\').each(function () {
                $(this).wrap($(\'<a/>\', {
                    href: $(this).attr(\'src\'),
                    class: "fancybox",
                    rel: "blog",
                    "data-fancybox":"blog"
                }));
            });
          
            var $visible = $(\'.fancybox\');
            $("body").on("click",".fancybox",function(e){
                e.preventDefault();
                $.fancybox.open( $visible, {
                    infobar : true,
                    arrows  : true,
                    loop : true,
                    image : {
                        preload : "auto",
                    },
                    thumbs : {
                        autoStart : true
                    }
                }, $visible.index( this ) );

                return false;
            });
', CClientScript::POS_READY);
?>

<style>
    a.fancybox {
        cursor: zoom-in;
    }
</style>