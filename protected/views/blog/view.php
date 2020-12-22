<?php
Yii::app()->clientScript
    ->registerCssFile(Yii::app()->theme->baseUrl . '/css/fancybox/jquery.fancybox.min.css?v=0.1')
    ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/fancybox/jquery.fancybox.min.js', CClientScript::POS_END);
//  meta tags and breadcrumbs
$categoryName = '';
$title = $model->getTitle();
$lang_code = Yii::app()->language;

$url = $model->getUrl();
$imageBigPath = $img_path = $model->getThumbPath(300, 335, 'w');
$document = $model->documents;
if (isset($document)){
        $document = $document[0];
        $altImage = $document->alt;
        $authorImage = $document->author;
        if (strlen($altImage) == 0){
            $altImage = $title;
        }

}
//$shareImgPath = $model->getThumbPath(1200, 630, 'auto');

if (isset($model->related_document)) {
    if ($model->related_document->resized_imagesize) {
        list($width_orig, $height_orig) = $model->related_document->resized_imagesize;
    }
    $imageBigPath = $model->related_document->getRealPath();
}

$desc = Yii::app()->controller->truncate($title, 25, 300);
$modelCategory = $model->category;
$this->subCategoryModel = $modelCategory;

if (isset($modelCategory)) {
    $this->breadcrumbs = array_merge(
        $this->breadcrumbs, $modelCategory->getBreadcrumbs(true)
    );
    $categoryName = " | " . $modelCategory->name;
}

$this->pageTitle = $title . $categoryName;
$this->meta_description = $model->getDescription(true);
$this->meta_keyword = $model->{tags . $lang_code}->toString();
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

    <div class="col-sm-9 border-left level2_cont_right">
        <div class="">

            <h1 class="blog_header" itemprop="name"> <?php echo $title; ?></h1>
            <div class="article_stats">
                <div class="article_header_date" itemprop="dateCreated"
                     datetime="<?php echo $this->dateToW3C($model->date_added); ?>"><?php echo $this->renderDateTime($model->date_added); ?></div>
                <div class="post-item__comments"><i
                        class="fa fa-comment"></i><span> <?php echo $model->getCommentCount(); ?> </span></div>
                <div class="post-item__views"><i class="fa fa-eye"></i><span><?php echo $model->visited_count; ?></span>
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
                        <?php echo CHtml::link(CHtml::image($img_path, $title, array('title' => $title, 'itemprop' => 'associatedMedia', 'alt' => $altImage)), $imageBigPath, array('class' => 'fancybox', 'rel' => 'blog', 'data-fancybox' => 'blog', 'data-width' => $width_orig, 'data-height' => $height_orig,)); ?>
                    </span>
                    <?php
                        if (strlen($authorImage) > 0):
                    ?>
                            <br><span class="source_img"><?=$authorImage?></span>
                        <?php
                            endif; ?>
                </div>
            <?php } ?>


            <div class="article_text" itemprop="articleBody">
                <?php
                $date_added = new DateTime($model->date_added);
                $date_renew = new DateTime("2014-12-01");

                if ($date_added > $date_renew) {
                    echo $model->getText();
                } else {
                    echo nl2br($model->getText());
                }

                //                if ($this->isMobile()) {
                //                    echo Yii::t('app', 'line_follow') . ' : ' . CHtml::link(Yii::t('app', 'turkmenportal.com'), 'https://line.me/R/ti/p/%40gvz1026i', array('style' => 'color:#00b900; font-weight:bold'));
                //                    echo "</br>";
                //                    echo Yii::t('app', 'line_follow') . ' : ' . CHtml::link(Yii::t('app', 'SPORT TURKMENPORTAL'), 'https://line.me/R/ti/p/%40xlz6070a', array('style' => 'color:#00b900; font-weight:bold'));
                //                }

                ?>
            </div>

            <?php if (isset($model->web) && strlen(trim($model->web)) > 0) { ?>
                <div class="web_address">
                    <?php echo Yii::t('app', 'detailed') . ": " . $model->web; ?>
                </div>
            <?php } ?>


            <div class="row">
                <div class="col-md-12 ">
                    <?php
                    $this->widget('application.widgets.banners.BannersWidget', array(
                        'type' => 'mobileBannerLevel2',
                        'outer_css_class' => 'mobile-responsive visible-xs',
                        'outer_css_id' => 'mobileBannerLevel2',
                    ));
                    ?>
                </div>
            </div>

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
                        <p class="note pull-left orphus"><?php echo Yii::t('app', 'orphus_message'); ?></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 ">
                    <?php
                    $this->widget('application.widgets.banners.BannersWidget', array(
                        'type' => 'bannerE',
//                        'outer_css_id' => 'banner1',
                        'inner_css_style' => 'max-width:100%',
                        'height' => '',
                        'outer_css_class' => 'mobile-responsive hidden-sm',
//                        'outer_css_id' => 'bannerLevel3',
                    ));
                    ?>
                </div>
            </div>

            <?php $this->beginWidget('DNofollowWidget'); ?>
            <?php
            $this->renderPartial('//comments/add_comment', array('related_relation' => 'blogs', 'related_relation_id' => $model->getPrimaryKey()));
            ?>

            <!--            <div class="row">-->
            <?php
//            $this->widget('application.widgets.banners.BannersWidget', array(
//                'type' => 'lentaInform',
//                'outer_css_class' => 'row',
//                'outer_css_id' => 'lentaInform',
//            ));
            ?>
            <!--            </div>-->

            <?php
            $this->widget('application.widgets.news.RelatedNewsWidget', array(
                'count' => 6,
                'category_id' => $modelCategory->id,
                'except' => $model->id,
            ));
            ?>

            <?php
            $this->widget('application.widgets.banners.BannersWidget', array(
                'type' => 'matched_content',
                'outer_css_id' => 'matched_content',
            ));
            ?>
            <?php $this->endWidget(); ?>


        </div>
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
