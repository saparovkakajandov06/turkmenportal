<?php
//    $modelCategory = $model->category;
//    if(isset($modelCategory)){
//        $this->breadcrumbs = array_merge(
//            $this->breadcrumbs,
//            $modelCategory->getBreadcrumbs(true)
//        );
//    }

$categoryName = '';
$title = $model->getTitle();
$lang_code = Yii::app()->language;

$url = $model->getUrl();
//$imageBigPath = $img_path = $model->getThumbPath(300, 335, 'w');
$desc = Yii::app()->controller->truncate($title, 25, 300);
$modelCategory = $model->category;
//    $this->subCategoryModel = $modelCategory;

if (isset($modelCategory)) {
    $this->breadcrumbs = array_merge(
        $this->breadcrumbs, $modelCategory->getBreadcrumbs(true)
    );
    $categoryName = " | " . $modelCategory->name;
}

$imageBigPath = "";
$mainDoc = $model->getDocument();
if (isset($mainDoc)) {
    $this->page_image = Yii::app()->getBaseUrl(true) . $mainDoc->getRealPath();
}

$this->page_url = $url;
$this->pageTitle = $title . $categoryName;
$this->meta_description = $model->getDescription();
$this->meta_keyword = $model->{tags . $lang_code}->toString();
$this->is_inner_breadcrumb = false;

?>


<div class="row">

    <!--    <div class="col-sm-3 col-xs-12">-->
    <!--        --><?php //$this->renderPartial('//layouts/common/column2_left'); ?>
    <!--    </div>-->


    <div class="col-xs-12 col-md-12 level2_cont_right">

        <?php
        $this->widget('application.widgets.banners.BannersWidget', array (
            'type' => 'left_sidebar',
            'outer_css_id' => 'left_sidebar',
        ));
        ?>

        <h1 class="blog_header"> <?php echo $title; ?></h1>

        <div class="article_stats">
            <time class="article_header_date" itemprop="dateCreated"
                  datetime="<?php echo $this->dateToW3C($model->date_added); ?>"><?php echo $this->renderDateTime($model->date_added); ?></time>
            <div class="post-item__comments"><i
                    class="fa fa-comment"></i><span> <?php echo $model->getCommentCount(); ?> </span></div>
            <div class="post-item__views"><i class="fa fa-eye"></i><span><?php echo $model->visited_count; ?></span>
            </div>
        </div>

        <?php
        if (isset($mainDoc) && $mainDoc->getVideoPath()) {
            $this->widget('application.widgets.videojs.VideoJs', array (
                'item_class' => 'col-sm-3 col-md-3',
                'document' => $model->related_document,
                'width' => '850',
            ));
        } elseif ($model->is_photoreport) {
            Yii::app()->clientScript
                ->registerCssFile(Yii::app()->theme->baseUrl . '/css/fancybox/jquery.fancybox.min.css?v=0.1')
                ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/fancybox/jquery.fancybox.min.js', CClientScript::POS_END)
                ->registerScript('gallery', '   
                        var $visible = $(\'.fancybox\');
                        $("body").on("click",".fancybox",function(e){
                            e.preventDefault();
                            $.fancybox.open( $visible, {
                                infobar : true,
                                arrows  : true,
                                loop : true,
                                protect: true,
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


            <div class="article_text" itemprop="articleBody">
                <?php echo $model->getText(); ?>
            </div>
            <div class="gallery_images">
                <div class="col-md-12">
                    <div class="row">
                        <?php
                        $col_count = (Yii::app()->controller->isMobile()) ? 2 : 4;
                        $documents = $model->documents;
                        if (count($documents) > 1) {
                            for ($i = 0; $i < $col_count; $i++) { ?>
                                <div class="col-md-3 col-xs-6 column">
                                    <?php
                                    for ($j = $i; $j < count($documents); $j += $col_count) {
                                        if (isset($documents[$j]))
                                            $document = $documents[$j];
                                        else
                                            continue;
                                        $img_width = 220;
                                        $img_height = 165;
                                        $image = $document->resize($img_width, $img_height, "w", true);
                                        if ($document->resized_imagesize) {
                                            list($width_orig, $height_orig) = $document->resized_imagesize;
                                        }
                                        $imageBig = $document->getRealPath();
                                        ?>

                                        <a class="fancybox <?= $css_class ?>"
                                            <?php
                                            if (isset($width_orig) && isset($height_orig)) {
                                                echo ' data-width="' . $width_orig . '"';
                                                echo ' data-height="' . $height_orig . '"';
                                            }
                                            if (isset($document->caption) && strlen(trim($document->caption)) > 0) {
                                                echo ' data-caption="' . $document->caption . '"';
                                            }
                                            ?>
                                           data-fancybox="photoreport" href="<?php echo $imageBig; ?>">
                                            <img src="<?php echo $image; ?>"/>
                                        </a>
                                    <?php } ?>
                                </div>
                            <?php }
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php } ?>


        <!--noindex-->
        <div class="social_panel">
            <div class="row">
                <div class="col-md-12 ">
                    <div class=" pull-left">
                        <?php
                        if (isset($model)) {
                            $this->widget('application.extensions.yii-yashare.YaShare', array (
                                'services' => 'vkontakte,twitter,facebook,gplus,odnoklassniki,moimir',
                                'title' => 'Поделиться в социальной сети:',
                            ));
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $this->widget('application.widgets.banners.BannersWidget', array (
            'type' => 'left_sidebar',
            'outer_css_id' => 'left_sidebar',
        ));
        ?>

        <!--        <p class="note pull-left orphus">--><?php //echo Yii::t('app', 'orphus_message'); ?><!--</p>-->


        <?php $this->beginWidget('DNofollowWidget'); ?>

        <?php
        $this->renderPartial('//comments/add_comment', array ('related_relation' => 'blogs', 'related_relation_id' => $model->getPrimaryKey()));
        ?>

        <?php
        $model->except = array ($model->id);
        $dp = $model->searchForCategory(5, false);
        if ($dp->getTotalItemCount() > 0) { ?>
            <div class="comments__head"><?php echo Yii::t('app', 'Related news'); ?></div>
            <div class="row">
                <?php
                $related_view = '_related_listview';
                if (Yii::app()->controller->isMobile())
                    $related_view = '_related_listview_mobile';


                $this->widget('bootstrap.widgets.BootListView', array (
                    'dataProvider' => $dp,
                    'itemView' => $related_view,
                    'summaryText' => '',
                    'emptyText' => '',
                ));
                ?>
            </div>
        <?php } ?>

        <?php
        $this->widget('application.widgets.banners.BannersWidget', array (
            'type' => 'matched_content_photoreport',
            'outer_css_id' => 'matched_content_photoreport',
        ));
        ?>

        <?php $this->endWidget(); ?>
        <!--/noindex-->
    </div>


</div>

<style>
    .fancybox img {
        max-width: 100%;
        margin-top: 2px;
    }

    .column {
        padding: 1px
    }

</style>