<div class="entry style-media media type-post">

    <div class="offer-card__box clear">
        <?php if (isset($data->price) && strlen(trim($data->price)) > 0) { ?>
            <div class="offer-card__info">
                <div class="offer-card__price">
                    <i><?php
                        $data->price = (double)$data->price;
                        if (is_double($data->price))
                            echo number_format($data->price, 0);
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
            <figure class="entry-thumbnail compositions car">
                <?php echo CHtml::link(CHtml::image($thumb), $data->getUrl(), array('class' => "thumb")); ?>
            </figure>
        <?php } ?>


        <header class="entry-header">
            <h4 class="entry-title">
                <?php
                $title = $data->getTitle();
                echo CHtml::link(Yii::app()->controller->truncate($title, 15, 150), $data->url, array('alt' => $title, 'title' => $title, 'rel' => 'bookmark'));
                ?>
            </h4>
            <div class="post-content detail">
                <?php
                //                    $content_text="";
                //                    $content_text.=Yii::t('app','make_id').' '.$data->getModel().', ';
                //                    $content_text.=Yii::t('app','color')." ".$data->getColorText().', ';
                //                    $content_text.=Yii::t('app','bodytype')." ".$data->getBodyTypeText().', ';
                //                    $content_text.=Yii::t('app','trip')." <i>".$data->trip."</i> ".$data->getOdometerUnitText().', ';
                //                    $content_text.=Yii::t('app','transmission')." ".$data->getTransmissionText().', ';
                //                    $content_text.=Yii::t('app','engine_capacity')." ".$data->engine_capacity.Yii::t('app', 'litre').', ';
                //                    $content_text.=Yii::t('app','drivetrain')." ".$data->getDrivetrainText().'. ';
                //
                //                    echo $content_text;
                echo $data->getDetails();
                ?>
            </div>
        </header>
        <div class="post-content auto">
            <?php
                echo Yii::app()->controller->truncate($data->description, 25, 400);
            ?>
        </div>

        <div class="offer-card__data">
            <div class="offer-card__foot">
                <div class="offer-card__contacts">
                    <span class="offer-card__contacts__item">
                        <?php echo $data->getRegionName(); ?>
                    </span>
                    <div class="offer-card__contacts__date ">
                    <span class="offer-card__contacts__item offer-card__contacts__item_dotted">
                        <!--noindex-->
                        <time itemprop="dateCreated"
                              datetime="<?php echo Yii::app()->controller->dateToW3C($data->date_added); ?>"><?php echo Yii::app()->controller->renderDateToWord($data->date_added); ?></time>
                        <!--/noindex-->
                    </span>
                    </div>
                    <?php if(isset($data->mail) && strlen(trim($data->mail))>0) {?>
                    <span class="offer-card__contacts__item offer-card__contacts__item_dotted">
                        <?php echo $data->mail; ?>
                    </span>
                    <?php } ?>

                    <span class="offer-card__contacts__item offer-card__contacts__item_dotted">
                        <i class="fa fa-eye"></i>
                        <?php echo $data->views; ?>
                    </span>

                </div>


            </div>
        </div>


    </div>
</div>



<?php
//if (isset($index) && $index == Yii::app()->controller->adsense_listview_index) { ?>
<!--    --><?php
//    $this->widget('application.widgets.banners.BannersWidget', array(
//        'type' => 'auto_desktop_listview',
//        'outer_css_class' => 'entry style-media media type-post',
//        'outer_css_id' => 'auto_desktop_listview',
//    ));
//    ?>
<?php //} ?>
