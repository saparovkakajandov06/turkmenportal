<div data-key="<?php echo $data->id; ?> ">    <!--if model->status == 1-->
    <div class="client-item-wrap row">
        <div class="client-item  default">
            <?php
            $thumb_path = $data->getThumbPath(190, 150, 'w');
            if (isset($thumb_path) && strlen(trim($thumb_path)) > 0) { ?>
                <div class="col-md-3 client-image">
                    <span class="media-object pull-left">
                    <?php echo CHtml::link(CHtml::image($thumb_path, $title), $data->url, array('class' => "thumb")); ?>
                </span>
                </div>
            <?php } ?>
            <div class="col-md-9 client-details">
                <div class="client-title">
                    <h4 class="margin-right-md">
                        <?php
                        $title = $data->getTitle();
                        //                          $title=  str_replace($title, "\\", "");
                        echo CHtml::link(Yii::app()->controller->truncate($title, 15, 450), $data->url, array('alt' => $title, 'title' => $title,'rel' => 'bookmark'));
                        ?>
                    </h4>

                    <div class="entry-meta article_stats ">
                        <time class="composition_date" itemprop="dateCreated"
                              datetime="<?php echo Yii::app()->controller->dateToW3C($data->date_added); ?>"><?php echo Yii::app()->controller->renderDateToWord($data->date_added); ?></time>
                        <div class="composition_date post-item__views"><i
                                class="fa fa-eye"></i><span><?php echo $data->views; ?></span></div>
                    </div>
                </div>

                <div class="client-details-item">
                    <?php
                    echo $data->category->name;
                    ?>
                </div>

                <div class="client-details-item">
                    <?php
                    echo $data->getProfession();
                    ?>
                </div>
                <div class="client-details-item">
                    <?php
                    $regionName = $data->getRegionName();
                    if (isset($regionName) && strlen(trim($regionName)) > 2) { ?>
                        <i class="fa fa-map-marker"></i>
                        <?php echo $regionName; ?>
                    <?php } ?>
                </div>

                <div class="client-details-item">
                    <?php if (isset($data->address) && strlen(trim($data->address)) > 2) { ?>
                        <i class="fa fa-map-marker"></i>
                        <?php
                        echo $data->address;
                        ?>
                    <?php } ?>
                </div>

<!--                <div class="client-details-item">-->
<!--                    --><?php //if (isset($data->phone) && strlen(trim($data->phone)) > 2) { ?>
<!--                        <i class="fa fa-phone"></i>-->
<!--                        --><?php //echo $data->phone; ?><!--<br>-->
<!--                    --><?php //} ?>
<!--                </div>-->

<!--                <div class="client-details-item">-->
<!--                    --><?php //if (isset($data->date_modified) && strlen(trim($data->date_modified)) > 2) { ?>
<!--                        <span class="entry-date"> <time-->
<!--                                datetime="--><?php //echo Yii::app()->controller->dateToW3C($data->date_modified); ?><!--"> --><?php //echo Yii::app()->controller->renderDate($data->date_modified); ?><!--</time></span>-->
<!--                        </br>-->
<!--                    --><?php //} ?>
<!--                </div>-->
            </div>

        </div>

    </div>
</div>