<?php
$categoryName = '';
$title = $model->getTitle();
$lang_code = Yii::app()->language;


$url = $model->getUrl();
$modelCategory = $model->category;
?>


<div class="row">
    <h1 class="blog_header"> <?php echo $title; ?></h1>

    <div class="article_stats">
        <time class="article_header_date" itemprop="dateCreated"
              datetime="<?php echo $this->dateToW3C($model->date_added); ?>"><?php echo $this->renderDateTime($model->date_added, true); ?></time>
    </div>


    <div class="row" style="margin-top: 25px">

        <?php if (isset($model->create_username) && strlen(trim($model->create_username)) > 2) { ?>
            <div style="display:block">
                <div style="display:inline-block">
                    <?php echo $model->getAttributeLabel('create_username') . ": "; ?>
                </div>
                <div style="display:inline-block"><b> <?php echo $model->create_username; ?></b></div>
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


        <?php if (isset($model->web) && strlen(trim($model->web)) > 2) { ?>
            <div style="display:block">
                <div style="display:inline-block">
                    <?php echo $model->getAttributeLabel('web') . ": "; ?>
                </div>
                <div style="display:inline-block"><b><?php echo $model->web; ?></b></div>
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
            $content = $model->getContent();
            echo $content;
            ?>
        </div>
    </div>

</div>




