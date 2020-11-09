<?php
$categoryName = '';
$title = $model->getTitle();
$lang_code = Yii::app()->language;


$url = $model->getUrl();
$modelCategory = $model->category;

$this->pageTitle = $title . $categoryName;
$this->meta_description = $model->getDescription();
?>

<div class="row">
    <h1 class="blog_header"> <?php echo $title; ?></h1>

    <div class="article_stats">
        <time class="article_header_date" itemprop="dateCreated"
              datetime="<?php echo $this->dateToW3C($model->date_added); ?>"><?php echo $this->renderDateTime($model->date_added,true); ?></time>
    </div>


    <div class="row" style="margin-top: 25px">
        <div class="col-md-7 col-xs-12">
            <?php if (isset($model->owner) && strlen(trim($model->owner)) > 2) { ?>
                <div style="display: block">
                    <div style="display: inline-block">
                        <?php echo $model->getAttributeLabel('owner') . ": "; ?>
                    </div>
                    <div style="display: inline-block"><b> <?php echo $model->owner; ?></b></div>
                </div>
            <?php } ?>

            <?php if (isset($model->create_username) && strlen(trim($model->create_username)) > 2) { ?>
                <div style="display: block">
                    <div style="display: inline-block">
                        <?php echo $model->getAttributeLabel('create_username') . ": "; ?>
                    </div>
                    <div style="display: inline-block"><b> <?php echo $model->create_username; ?></b></div>
                </div>
            <?php } ?>


            <?php if (isset($model->edited_username) && strlen(trim($model->edited_username)) > 2) { ?>
                <div style="display:block">
                    <div style="display:inline-block">
                        <?php echo $model->getAttributeLabel('edited_username') . ": "; ?>
                    </div>
                    <div style="display:inline-block"><b> <?php echo $model->edited_username; ?></b></div>
                </div>
            <?php } ?>

            <?php if (isset($model->address) && strlen(trim($model->address)) > 2) { ?>
                <div style="display: block">
                    <div style="display: inline-block">
                        <?php echo $model->getAttributeLabel('address') . ": "; ?>
                    </div>
                    <div style="display: inline-block"><b> <?php echo $model->address; ?></b></div>
                </div>
            <?php } ?>


            <?php if (isset($model->phone) && strlen(trim($model->phone)) > 2) { ?>
                <div style="display: block">
                    <div style="display: inline-block">
                        <?php echo $model->getAttributeLabel('phone') . ": "; ?>
                    </div>
                    <div style="display: inline-block"><b><?php echo $model->phone; ?></b></div>
                </div>
            <?php } ?>


            <?php if (isset($model->mail) && strlen(trim($model->mail)) > 2) { ?>
                <div style="display: block">
                    <div style="display: inline-block">
                        <?php echo $model->getAttributeLabel('mail') . ": "; ?>
                    </div>
                    <div style="display: inline-block"><b><?php echo $model->mail; ?></b></div>
                </div>
            <?php } ?>

            <?php if (isset($model->price) && strlen(trim($model->price)) > 2) { ?>
                <div style="display: block">
                    <div style="display: inline-block">
                        <?php echo $model->getAttributeLabel('price') . ": "; ?>
                    </div>
                    <div style="display: inline-block"><b><?php echo $model->price; ?></b></div>
                </div>
            <?php } ?>


            <?php if (isset($model->web) && strlen(trim($model->web)) > 2) { ?>
                <div style="display: block">
                    <div style="display: inline-block">
                        <?php echo $model->getAttributeLabel('web') . ": "; ?>
                    </div>
                    <div style="display: inline-block"><b><?php echo $model->web; ?></b></div>
                </div>
            <?php } ?>



            <?php if (isset($modelCategory)) { ?>
                <div style="display: block">
                    <div style="display: inline-block">
                        <?php echo $model->getAttributeLabel('category_id') . ": "; ?>
                    </div>
                    <div style="display: inline-block"><b><?php echo $modelCategory->getFullTitle(false,' / '); ?></b></div>
                </div>
            <?php } ?>

            <?php if (isset($model->url)) { ?>
                <div style="display: block">
                    <div style="display: inline-block">
                        <?php echo Yii::t('app','source') . ": "; ?>
                    </div>
                    <div style="display: inline-block"><b><?php echo $model->url; ?></b></div>
                </div>
            <?php } ?>
        </div>


        <div class="row" style="margin-top: 25px">
            <div>
                <?php
                $content = $model->getContent();
                if (!isset($content) || strlen(trim($content)) < 5) {
                    $content = $model->getDescription();
                }
                echo $content;
                ?>
            </div>
        </div>
    </div>
</div>




