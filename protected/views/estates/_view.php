<div class="entry style-media media type-post">

    <div class="offer-card__box clear">
        <?php if (isset($data->price) && strlen(trim($data->price)) > 0) { ?>
            <div class="offer-card__info">
                <div class="offer-card__price">
                    <i><?php echo $data->price; ?></i>
                    <span class="offer-card__price__note">
                    <?php echo $data->getCurrency($data->currency); ?>
                </span>
                </div>
            </div>
        <?php } ?>


        <?php
        $thumb = $data->getThumbPath(180, 100, 'w', true);
        if (isset($thumb) && strlen(trim($thumb)) > 0) {
            ?>
            <figure class="entry-thumbnail compositions">
                <?php echo CHtml::link(CHtml::image($thumb), $data->getUrl(), array('class' => "thumb")); ?>
            </figure>
        <?php } ?>


        <header class="entry-header">
            <h4 class="entry-title">
                <?php
                $title = $data->getTitle();
                echo CHtml::link($title, $data->url, array('alt' => $title, 'rel' => 'bookmark'));
                ?>
            </h4>
        </header>


        <div class="offer-card__data">
            <?php if (isset($data->description) && strlen(trim($data->description)) > 0) { ?>
                <div class="post-content estate_desc">
                    <?php echo Yii::app()->controller->truncate($data->description, 15, 450); ?>
                </div>
            <?php } ?>
            <div class="post-content estate">
                <?php
                $content_text = "";
                $content_text .= Yii::t('app', 'type') . ': ' . $data->getTypeText() . ', ';
                if (isset($data->room) && strlen(trim($data->room)) > 0 && is_numeric($data->room) && $data->room > 0)
                    $content_text .= Yii::t('app', 'room') . ": " . $data->room . ', ';
                if (isset($data->year) && strlen(trim($data->year)) > 0)
                    $content_text .= Yii::t('app', 'year') . ": " . $data->year . ', ';
                if (isset($data->meter) && strlen(trim($data->meter)) > 0)
                    $content_text .= Yii::t('app', 'meter') . ": " . $data->meter . '. ';
                echo $content_text;
                ?>

            </div>

            <div class="offer-card__foot">
                <div class="offer-card__contacts">
                    <?php if (isset($data->mail) && strlen(trim($data->mail)) > 1) { ?>
                        <span class="offer-card__contacts__item">
                            <?php echo $data->mail; ?>
                        </span>
                    <?php } ?>

                    <?php
                    $region_name = $data->getRegionName();
                    if (isset($region_name) && strlen(trim($region_name)) > 1) { ?>
                        <span class="offer-card__contacts__item offer-card__contacts__item_dotted">
                            <?php echo $region_name; ?>
                        </span>
                    <?php } ?>

                    <?php if (isset($data->date_added)) { ?>
                        <div class="offer-card__contacts__date ">
                        <span class="offer-card__contacts__item offer-card__contacts__item_dotted">
                            <!--noindex-->
                            <time itemprop="dateCreated"
                                  datetime="<?php echo Yii::app()->controller->dateToW3C($data->date_added); ?>"><?php echo Yii::app()->controller->renderDateToWord($data->date_added); ?></time>
                            <!--/noindex-->
                        </span>
                        </div>
                    <?php } ?>
                </div>


            </div>
        </div>


    </div>
</div>
