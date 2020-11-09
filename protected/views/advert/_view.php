<div data-key="<?php echo $data->id; ?> ">    <!--if model->status == 1-->
    <div class="client-item-wrap row">
        <div class="client-item  default">

            <?php
            $thumb_path = $data->getThumbPath(190, 150, 'w');
            if (isset($thumb_path) && strlen(trim($thumb_path)) > 0) { ?>
                <div class="col-md-3 col-xs-12 client-image">
                        <span class="media-object">
                            <?php echo CHtml::link(CHtml::image($thumb_path, $title), $data->url, array('class' => "thumb")); ?>
                        </span>
                </div>
            <?php } ?>

            <div class="col-md-9 col-xs-12 client-details">
                <div class="client-title">
                    <h4 class="margin-right-md">
                        <?php
                        $title = $data->getTitle();
                        echo CHtml::link(Yii::app()->controller->truncate($title, 15, 450), $data->url, array('alt' => $title, 'title' => $title, 'rel' => 'bookmark'));
                        ?>
                    </h4>
                </div>

                <div class="client-details-item">
                    <i class="fa fa-tag"></i>
                    <?php
                    echo $data->category->name;
                    ?>
                </div>

                <div class="client-details-item">
                    <?php
                    echo Yii::app()->controller->truncate($data->description, 15, 450);
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

                <div class="client-details-item">
                    <?php if (isset($data->date_added) && strlen(trim($data->date_added)) > 2) { ?>
                        <i class="fa fa-calendar"></i>
                        <?php echo Yii::app()->controller->renderDateToWord($data->date_added); ?><br>
                    <?php } ?>
                </div>


                <div class="client-details-item">
                    <i class="fa fa-eye"></i>
                    <?php echo $data->views; ?>
                </div>

            </div>


        </div>
    </div>
</div>