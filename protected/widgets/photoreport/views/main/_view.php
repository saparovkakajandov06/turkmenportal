



<div class="<?php echo $this->item_class; ?> col-padding-reset">
    <span class="media-object responsive" >
        <?php echo CHtml::link(CHtml::image($data->getThumbPath(200,130,'auto',true),$title), $data->url, array('class'=>"thumb")); ?>
        <span class="c-photo__text__inner__gallcount">
            <span class="c-photo__text__inner__gallcount__text"><?php echo $data->documents_count; ?></span>
        </span>
    </span>

    <div class="style-media-list">

        <h3 class="entry-title">
            <?php
            $title = $data->getTitle();
            echo CHtml::link(Yii::app()->controller->truncate($title, 20, 400), $data->url, array('alt' => $title,'title' => $title,'rel' => 'bookmark'));
            ?>
        </h3>


    </div>
</div>

<article class="entry style-grid style-hero hero-sm-largest type-post item_photoreport col-xs-6 col-sm-4 col-md-4 col-lg-4 colheight-sm-1 ">
    <header class="entry-header">
        <h4 class="entry-title">
            <a class="banner_link" href="/photoreport/127/%C3%9Durdumyzy%C5%88-a%C3%BDratyn-tapawutlanan-zehinli-%C3%A7agalaryna-gulbaba-adyndaky-%C3%87agalar-ba%C3%BDragy">Ýurdumyzyň aýratyn tapawutlanan zehinli çagalaryna Gulbaba adyndaky Çagalar baýragy</a>            </h4>
    </header>

    <figure class="entry-thumbnail">
        <a class="overlay overlay-primary" href="/photoreport/127/%C3%9Durdumyzy%C5%88-a%C3%BDratyn-tapawutlanan-zehinli-%C3%A7agalaryna-gulbaba-adyndaky-%C3%87agalar-ba%C3%BDragy"><img src="/images/uploads/cache/blogs/b21d487f85f1b45a359aa906e911f835-385x4354.jpg" alt="Ýurdumyzyň aýratyn tapawutlanan zehinli çagalaryna Gulbaba adyndaky Çagalar baýragy"></a>        </figure>



    <span class="c-photo__text__inner__gallcount">
            <span class="c-photo__text__inner__gallcount__text"><?php echo $data->documents_count; ?></span>
        </span>
</article>