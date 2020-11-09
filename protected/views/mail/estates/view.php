<?php
$categoryName = '';
$title = $model->getTitle();
$lang_code = Yii::app()->language;


$url = $model->getUrl();
//$img_path = $model->getThumbPath(300, 335, 'w');
$modelCategory = $model->category;
//$this->subCategoryModel = $modelCategory;

$this->pageTitle = $title . $categoryName;
$this->meta_description = $model->getDescription();
?>


<div class="row">
    <h1 class="blog_header"> <?php echo $title; ?></h1>

    <div class="article_stats">
        <time class="article_header_date" itemprop="dateCreated"
              datetime="<?php echo $this->dateToW3C($model->date_added); ?>"><?php echo $this->renderDateTime($model->date_added, true); ?></time>
    </div>


    <div class="row" style="margin-top: 25px">
        <div style="display: block">
            <div style="display: inline-block">
                <?php echo $model->getAttributeLabel('title') . ": "; ?>
            </div>
            <div style="display: inline-block"><b><?php echo $model->getFulltitle(); ?></b>
            </div>
        </div>



        <?php if (isset($model->owner) && strlen(trim($model->owner)) > 2) { ?>
            <div style="display:block">
                <div style="display:inline-block">
                    <?php echo $model->getAttributeLabel('owner') . ": "; ?>
                </div>
                <div style="display:inline-block"><b> <?php echo $model->owner; ?></b></div>
            </div>
        <?php } ?>



        <?php if (isset($model->phone) && strlen(trim($model->phone)) > 2) { ?>
            <div style="display:block">
                <div style="display:inline-block">
                    <?php echo $model->getAttributeLabel('phone') . ": "; ?>
                </div>
                <div style="display:inline-block"><b><?php echo $model->phone; ?></b></div>
            </div>
        <?php } ?>


        <?php if (isset($model->mail) && strlen(trim($model->mail)) > 2) { ?>
            <div style="display:block">
                <div style="display:inline-block">
                    <?php echo $model->getAttributeLabel('mail') . ": "; ?>
                </div>
                <div style="display:inline-block"><b><?php echo $model->mail; ?></b></div>
            </div>
        <?php } ?>


        <?php if (isset($model->web) && strlen(trim($model->web)) > 2) { ?>
            <div style="display:block">
                <div style="display:inline-block">
                    <?php echo $model->getAttributeLabel('web') . ": "; ?>
                </div>
                <div style="display:inline-block"><b><?php echo $model->web; ?></b></div>
            </div>
        <?php } ?>

        <?php if (isset($model->description) && strlen(trim($model->description)) > 2) { ?>
            <div style="display:block">
                <div style="display:inline-block">
                    <?php echo $model->getAttributeLabel('description') . ": "; ?>
                </div>
                <div style="display:inline-block"><b><?php echo $model->description; ?></b></div>
            </div>
        <?php } ?>



        <?php if (isset($modelCategory)) { ?>
            <div style="display: block">
                <div style="display: inline-block">
                    <?php echo $model->getAttributeLabel('category_id') . ": "; ?>
                </div>
                <div style="display: inline-block"><b><?php echo $modelCategory->getFullTitle(false, ' / '); ?></b>
                </div>
            </div>
        <?php } ?>




        <?php if (isset($model->url)) { ?>
            <div style="display: block">
                <div style="display: inline-block">
                    <?php echo Yii::t('app', 'source') . ": "; ?>
                </div>
                <div style="display: inline-block"><b><?php echo $model->url; ?></b></div>
            </div>
        <?php } ?>

    </div>


    <div class="row" style="margin-top: 25px">
        <div class="col-md-12">
            <?php
            $content = $model->getDescription();
            echo $content;
            ?>
        </div>
    </div>

</div>




