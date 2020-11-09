<div class="entry style-media media type-post">

    <div class="offer-card__box clear">
        <?php if (isset($data->price) && strlen(trim($data->price)) > 0) { ?>
            <div class="offer-card__info">
                <div class="offer-card__price">
                    <i><?php
                        $data->price = (double)$data->price;
                        if (is_double($data->price))
                            echo number_format($data->price, 2);
                        ?>
                    </i>
                    <span class="offer-card__price__note">
                    <?php
                    if (!isset($data->currency)) {
                        $data->currency = ItemForm::CURRENCY_MANAT;
                    }
                    echo $data->getCurrency($data->currency);
                    ?>
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


        <header class="entry-header1">
            <h4 class="advert_header">
                <?php
                $title = $data->getTitle();
                echo CHtml::link($title, $data->url, array('alt' => $title, 'rel' => 'bookmark'));
                ?>
            </h4>
        </header>


        <div class="offer-card__data">
            <div class="post-content">
                <?php
                echo $data->getDetails();
                ?>
            </div>

            <div class="offer-card__foot">
                <div class="offer-card__contacts">
                    <?php if(isset($data->mail) && strlen(trim($data->mail))>2){ ?>
                        <span class="offer-card__contacts__item">
                            <?php echo $data->mail; ?>
                        </span>
                    <?php } ?>

                    <?php if(isset($data->region_id)){ ?>
                        <span class="offer-card__contacts__item offer-card__contacts__item_dotted">
                            <?php echo $data->getRegionName(); ?>
                        </span>
                    <?php } ?>


                    <?php if(isset($data->date_added)){ ?>
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
