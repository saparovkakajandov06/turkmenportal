<?php
$data = $mainBlogModel;
$title = $data->getTitle();
?>

<div class="row">
    <div class="col-md-5 col-xs-12">
        <div class="main_news_block">
            <span class="media-object responsive">
                    <?php echo CHtml::link(CHtml::image($data->getThumbPath(510, 710, 'w', true), $title, array('class' => 'i_n_list_img', 'style' => 'width:100%', 'alt' => $title)), $data->url, array('class' => "thumb")); ?>
            </span>

            <div>
                <span class="entry-date">
                        <time
                                datetime="<?php echo Yii::app()->controller->dateToW3C($data->date_added); ?>"> <?php echo Yii::app()->controller->renderDate($data->date_added); ?></time>
                    </span>
                <h1 class="blog_header">

                    <?php
                    echo CHtml::link(Yii::app()->controller->truncate($title, 15, 200), $data->url, array('title' => $title, 'rel' => 'bookmark'));
                    ?>
                </h1>

                <div class="description_text main_item">
                    <?php
                    echo Yii::app()->controller->truncate($data->getDescription(), 200, 500);
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-7 col-xs-12 most_recent_news mobile_index_list">
        <?php
        $this->render('/tabs/_most_recent_news', array('blogModels' => $newestBlogModels));
        ?>

    </div>
</div>
