<?php
$itemCssClass = uniqid('carousel');

?>
    <div class="<?php echo $this->wrapper_class; ?>">
        <div class="section entries ">
            <!--            <div class="row">-->
            <!--                <div class="owlNavigation pull-right">-->
            <!--                    <a class="btn btn-circle prev "><i class="fa fa-arrow-left"></i></a>-->
            <!--                    <a class="btn btn-circle next "><i class="fa fa-arrow-right"></i></a>-->
            <!--                </div>-->
            <!--            </div>-->
            <div class="<?= $itemCssClass ?>">
                <?php
                if (isset ($photoreportModels)) {
                    foreach ($photoreportModels as $key => $data) {
                        $view_setting = array(
                            'data' => $data
                        );
                        if (isset($this->settings[$key])) {
                            $view_setting = array_merge($view_setting, $this->settings[$key]);
                        }
                        $this->render('//photoreport/_view', $view_setting);

                    } ?>

                    <?php if (isset($this->nextLink) && strlen(trim($this->nextLink)) > 2) { ?>
                        <article class="<?php echo $this->nextLinkCss; ?> item_photoreport next">
                            <header class="entry-header-last">
                                <?php echo CHtml::link('<span class="text"><span class="fa fa-camera"></span> ' . Yii::t('app', 'more photo_report') . '</span>', $this->nextLink, array('class' => 'banner_link')); ?>
                            </header>
                        </article>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>


<?php
Yii::app()->clientScript->registerScript('scripts', '
// function init(){
    var owl=$(".' . $itemCssClass . '").owlCarousel({
        autoPlay: false,
        slideSpeed: 2000,
        pagination: true,
        navigation: true,
        items: ' . $this->item_count . ',
    //    itemsCustom: [
    //      [0, 1],
    //      [450, 1],
    //      [480, 1],
    //      [600, 2],
    //      [700, 2],
    //      [768, 2],
    //      [992, 3],
    //      [1199, 3]
    //    ],
        /* transitionStyle : "fade", */    /* [This code for animation ] */
//        navigationText: [""],
        navigationText : ["<i class=\'fa fa-chevron-left\'></i>","<i class=\'fa fa-chevron-right\'></i>"]
      });

', CClientScript::POS_READY);

?>