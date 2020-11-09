<?php
echo "<pre>";
print_r(count($list));
echo "</pre>";
exit(1);
$carouselCssClass = uniqid('carousel');
$item_class = isset($this->item_class) ? $this->item_class : 'col-sm-4 col-md-4 col-lg-4 col-xl-4';
?>
    <div class="carousel-box">
        <div class="row">
            <div class="col-md-12">
                <?php if (isset($this->widget_title)) { ?>
                    <h3 class="widget-header pull-left"><?= $this->widget_title ?></h3>
                <?php } ?>
                <div class="owlNavigation pull-right">
                    <a class="btn btn-circle prev "><i class="fa fa-arrow-left"></i></a>
                    <a class="btn btn-circle next "><i class="fa fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="<?= $carouselCssClass ?>">
                <?php
                if (isset($list) && count($list) > 0) { ?>
                    <?php foreach ($list as $key => $model) {
                        $href = $model->url;
                        ?>
                        <div class="<?= $item_class ?>">
                            <article class="entry-carousel-box">

                                <div class="entry-image pull-left">
                                    <?php
                                    $imgsrc = $model->getThumbPath(450, 400, 'auto', true);
                                    echo CHtml::link(CHtml::image($imgsrc, ['alt' => '', 'class' => 'entry-featured-image-url']), $href);
                                    ?>
                                </div>

                                <div class="entry-content">
                                    <div class="item_meta_wrapper">
                                        <div class="entry-date inline">
                                            <time
                                                datetime="<?php echo Yii::$app->controller->dateToW3C($model->date_created); ?>"> <?php echo Yii::$app->controller->renderDate($model->date_created); ?></time>
                                        </div>
                                    </div>

                                    <div class="entry-header">
                                        <h6 class="entry-title">
                                            <?= Html::a($model->title, $href) ?>
                                        </h6>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>

            <!--        <div class="col-md-12">-->
            <!--            <div class="widget-show-all pull-left">-->
            <!--                --><?php //if (isset($this->show_all_url)) { ?>
            <!--                    <a href="--><? //= $this->show_all_url ?><!--">-->
            <? //= $this->show_all_title ?><!--<span-->
            <!--                            class="show_all_arrow"> <i class="fa fa-angle-right"></i> </span></a>-->
            <!--                --><?php //} ?>
            <!--            </div>-->
            <!--        </div>-->
        </div>
    </div>


<?php
Yii::app()->clientScript->registerScript('scripts', '
 function init(){
           var owl=$(".' . $carouselCssClass . '").owlCarousel({
            autoPlay: false,
            slideSpeed: 2000,
            loop:true,
            pagination: false,
            navigation: false,
            items: 2,
            navigationText: [""],
          });
          
      $(".next").click(function(){
        owl.trigger(\'owl.next\');
      })
      $(".prev").click(function(){
        owl.trigger(\'owl.prev\');
      })
  }
  
  init();
', CClientScript::POS_READY);

?>