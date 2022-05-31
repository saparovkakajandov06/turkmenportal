<div data-key="<?php echo $data->id; ?> ">    <!--if model->status == 1-->
    <div class="client-item-wrap row">
        <div class="col-md-12">
            <div class="client-item default">

                <?php if (isset($this->show_photo) && $this->show_photo == true) { ?>
                    <?php
                    $thumb_path = $data->getThumbPath(150, 150, 'w');
                    if (isset($thumb_path) && strlen(trim($thumb_path)) > 0) { ?>
                        <div class="entry-thumbnail compositions client-image">
                        <span class="media-object">
                            <?php echo CHtml::link(CHtml::image($thumb_path, $title), $data->url, array('class' => "thumb")); ?>
                        </span>
                        </div>
                    <?php } ?>
                <?php } ?>

                <div class="client-details">
                    <div class="client-title">
                        <h4 class="margin-right-md">
                            <?php
                            $title = $data->getTitle();
                            //                          $title=  str_replace($title, "\\", "");
                            echo CHtml::link(Yii::app()->controller->truncate($title, 15, 450), $data->url, array('alt' => $title,'title' => $title, 'rel' => 'bookmark'));
                            ?>
                        </h4>

                        <!--                    <span class="text-muted catalog-category">-->
                        <!--                        --><?php
                        //                            echo $data->category->name;
                        //                        ?>
                        <!--                    </span>-->
                    </div>

                    <div class="client-details-item">
                        <i class="fa fa-tag"></i>
                        <?php
                        echo $data->category->name;
                        ?>
                    </div>

                    <div class="client-details-item">
                        <?php
                        echo $data->description;
                        ?>

                        <?php if (isset($data->address) && strlen(trim($data->address)) > 2) { ?>
                            <i class="fa fa-map-marker"></i>
                            <?php
                            echo $data->address;
                            ?>
                        <?php } ?>
                    </div>

                    <div class="client-details-item">
                        <?php if (isset($data->phone) && strlen(trim($data->phone)) > 2) { ?>
                            <i class="fa fa-phone"></i>
                            <?php echo $data->phone; ?><br>
                        <?php } ?>
                    </div>

<!--                    <div class="client-details-item">-->
<!--                        --><?php //if (isset($data->date_added) && strlen(trim($data->date_added)) > 2) { ?>
<!--                            <i class="fa fa-calendar"></i>-->
<!--                            --><?php //echo Yii::app()->controller->renderDateToWord($data->date_added); ?><!--<br>-->
<!--                        --><?php //} ?>
<!--                    </div>-->


                    <div class="client-details-item">
                        <i class="fa fa-eye"></i>
                        <?php echo $data->views; ?>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>


<?php

if (isset($index) && $index == Yii::app()->controller->adsense_listview_index) { ?>
    <div class="client-item-wrap row">
        <div class="col-md-12">
            <div class="client-item default">
                <?php
                $this->widget('application.widgets.banners.BannersWidget', array(
                    'type' => 'listviewAd',
                    'outer_css_id' => 'listviewAd',
                ));
                ?>
            </div>
        </div>
    </div>
<?php } ?>