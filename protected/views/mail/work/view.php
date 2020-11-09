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
        <?php if (isset($model->profession_id) && strlen(trim($model->profession_id)) > 0) { ?>
            <div style="display: block">
                <div style="display: inline-block">
                    <?php echo $model->getAttributeLabel('profession_id') . ": "; ?>
                </div>
                <div style="display: inline-block"> <b> <?php echo $model->getProfession(); ?></b> </div>
            </div>
        <?php } ?>

        <?php if (isset($model->branch_id) && strlen(trim($model->branch_id)) > 0) { ?>
            <div style="display: block">
                <div style="display: inline-block">
                    <?php echo $model->getAttributeLabel('branch_id') . ": "; ?>
                </div>
                <div style="display: inline-block"> <b> <?php echo $model->getBranch(); ?></b> </div>
            </div>
        <?php } ?>

        <?php if (isset($model->education) && strlen(trim($model->education)) > 0) { ?>
            <div style="display: block">
                <div style="display: inline-block">
                    <?php echo $model->getAttributeLabel('education') . ": "; ?>
                </div>
                <div style="display: inline-block"> <b> <?php echo $model->getEducationText(); ?></b> </div>
            </div>
        <?php } ?>



        <?php if (isset($model->schedule) && strlen(trim($model->schedule)) > 0) { ?>
            <div style="display: block">
                <div style="display: inline-block">
                    <?php echo $model->getAttributeLabel('schedule') . ": "; ?>
                </div>
                <div style="display: inline-block"> <b> <?php echo $model->getScheduleText(); ?></b> </div>
            </div>
        <?php } ?>

        <?php if (isset($model->experience) && strlen(trim($model->experience)) > 0) { ?>
            <div style="display: block">
                <div style="display: inline-block">
                    <?php echo $model->getAttributeLabel('experience') . ": "; ?>
                </div>
                <div style="display: inline-block"> <b> <?php echo $model->getExperienceText(); ?></b> </div>
            </div>
        <?php } ?>

        <?php if (isset($model->computer_experience) && strlen(trim($model->computer_experience)) > 0) { ?>
            <div style="display: block">
                <div style="display: inline-block">
                    <?php echo $model->getAttributeLabel('computer_experience') . ": "; ?>
                </div>
                <div style="display: inline-block"> <b> <?php echo $model->computer_experience; ?></b> </div>
            </div>
        <?php } ?>

        <?php if (isset($model->languages) && strlen(trim($model->languages)) > 0) { ?>
            <div style="display: block">
                <div style="display: inline-block">
                    <?php echo $model->getAttributeLabel('languages') . ": "; ?>
                </div>
                <div style="display: inline-block"> <b> <?php echo $model->languages; ?></b> </div>
            </div>
        <?php } ?>

        <?php if (isset($model->salary) && strlen(trim($model->salary)) > 0) { ?>
            <div style="display: block">
                <div style="display: inline-block">
                    <?php echo $model->getAttributeLabel('salary') . ": "; ?>
                </div>
                <div style="display: inline-block"> <b> <?php echo $model->salary.' '.$model->getCurrencyText(); ?></b> </div>
            </div>
        <?php } ?>


        <?php if (isset($model->phone) && strlen(trim($model->phone)) > 2) { ?>
            <div style="display: block">
                <div style="display: inline-block">
                    <?php echo $model->getAttributeLabel('phone') . ": "; ?>
                </div>
                <div style="display: inline-block"> <b><?php echo $model->phone; ?></b></div>
            </div>
        <?php } ?>


        <?php if (isset($model->mail) && strlen(trim($model->mail)) > 2) { ?>
            <div style="display: block">
                <div style="display: inline-block">
                    <?php echo $model->getAttributeLabel('mail') . ": "; ?>
                </div>
                <div style="display: inline-block"> <b><?php echo $model->mail; ?></b></div>
            </div>
        <?php } ?>

        <?php if (isset($model->price) && strlen(trim($model->price)) > 2) { ?>
            <div style="display: block">
                <div style="display: inline-block">
                    <?php echo $model->getAttributeLabel('price') . ": "; ?>
                </div>
                <div style="display: inline-block"> <b><?php echo $model->price; ?></b></div>
            </div>
        <?php } ?>


        <?php if (isset($model->web) && strlen(trim($model->web)) > 2) { ?>
            <div style="display: block">
                <div style="display: inline-block">
                    <?php echo $model->getAttributeLabel('web') . ": "; ?>
                </div>
                <div style="display: inline-block"> <b><?php echo $model->web; ?></b></div>
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




