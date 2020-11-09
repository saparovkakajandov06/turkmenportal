
<article class="entry style-grid style-hero hero-sm-largest type-post <?php echo $cssClass; ?>">

    <header class="entry-header">
            <h4 class="entry-title">
                <?php echo CHtml::link($data->getTitle(),$data->getUrl(),array('class'=>'banner_link')); ?>
            </h4>
        </header>

        <figure class="entry-thumbnail">
            <?php
              echo CHtml::link(CHtml::image($data->getThumbPath($thumbWidth,$thumbHeight,'auto',true), $data->getTitle()),$data->getUrl(),array('class'=>"overlay overlay-primary"));
            ?>
        </figure>
    
       <span class="c-photo__text__inner__gallcount">
            <span class="c-photo__text__inner__gallcount__text"><?php echo $data->documents_count; ?></span>
        </span>

</article>