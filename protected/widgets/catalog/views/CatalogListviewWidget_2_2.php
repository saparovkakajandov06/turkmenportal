<?php
foreach ($items as $key => $data):
    if (($key >= ($count * $page - $count)) && ($key <= ($count * $page))):

        ?>
        <div class="row">
            <article class="type-catalog-item style-media-list media <?php echo $this->item_class; ?> colheight-index">
                <div class="inner_block ">
                    <?php
                    $title = $data->getTitle();

                    if (isset($this->show_photo) && $this->show_photo == true && !isset($data->documents)) { ?>
                        <span class=" pull-left media-object">
                <?php echo CHtml::link(CHtml::image($data->getThumbPath(40, 40, "h"), $title), $data->url, array('class' => "thumb", 'alt' => $title,)); ?>
            </span>
                    <?php } ?>

                    <div class="media-body">
                        <div class="article_stats_2">
                            <time class="article_header_date" itemprop="dateCreated"
                                  datetime="<?php echo Yii::app()->controller->dateToW3C($data->date_added); ?>"><?php echo Yii::app()->controller->renderDateTime($data->date_added); ?></time>
                            <div class="post-item__views"><i
                                        class="fa fa-eye"></i><span><?php echo $data->views; ?></span>
                            </div>
                        </div>
                        <h3 class="entry-title">
                            <?php
                            echo CHtml::link(Yii::app()->controller->truncate($title, 15, 450), $data->url, array('rel' => 'bookmark', 'title' => $title, 'class' => 'link')); ?>
                        </h3>

                    </div>

                </div>
            </article>
            <div class="tender_divider">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>
        </div>

    <?php
    endif;
endforeach;
?>

<div class="clearfix"></div>


