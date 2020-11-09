<?php
Yii::app()->clientScript
    ->registerCssFile(Yii::app()->theme->baseUrl . '/css/fancybox/jquery.fancybox.min.css?v=0.1')
    ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/fancybox/jquery.fancybox.min.js', CClientScript::POS_END)
    ->registerScript('jssor-slider', '
            var _SlideshowTransitions = [
            //Fade in L
                {$Duration: 1200, x: 0.3, $During: { $Left: [0.3, 0.7] }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
            //Fade out R
                , { $Duration: 1200, x: -0.3, $SlideOut: true, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
            //Fade in R
                , { $Duration: 1200, x: -0.3, $During: { $Left: [0.3, 0.7] }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
            //Fade out L
                , { $Duration: 1200, x: 0.3, $SlideOut: true, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }

            //Fade in T
                , { $Duration: 1200, y: 0.3, $During: { $Top: [0.3, 0.7] }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
            //Fade out B
                , { $Duration: 1200, y: -0.3, $SlideOut: true, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
            //Fade in B
                , { $Duration: 1200, y: -0.3, $During: { $Top: [0.3, 0.7] }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
            //Fade out T
                , { $Duration: 1200, y: 0.3, $SlideOut: true, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }

            //Fade in LR
                , { $Duration: 1200, x: 0.3, $Cols: 2, $During: { $Left: [0.3, 0.7] }, $ChessMode: { $Column: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
            //Fade out LR
                , { $Duration: 1200, x: 0.3, $Cols: 2, $SlideOut: true, $ChessMode: { $Column: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
            //Fade in TB
                , { $Duration: 1200, y: 0.3, $Rows: 2, $During: { $Top: [0.3, 0.7] }, $ChessMode: { $Row: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
            //Fade out TB
                , { $Duration: 1200, y: 0.3, $Rows: 2, $SlideOut: true, $ChessMode: { $Row: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }

            //Fade in LR Chess
                , { $Duration: 1200, y: 0.3, $Cols: 2, $During: { $Top: [0.3, 0.7] }, $ChessMode: { $Column: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
            //Fade out LR Chess
                , { $Duration: 1200, y: -0.3, $Cols: 2, $SlideOut: true, $ChessMode: { $Column: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
            //Fade in TB Chess
                , { $Duration: 1200, x: 0.3, $Rows: 2, $During: { $Left: [0.3, 0.7] }, $ChessMode: { $Row: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
            //Fade out TB Chess
                , { $Duration: 1200, x: -0.3, $Rows: 2, $SlideOut: true, $ChessMode: { $Row: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }

            //Fade in Corners
                , { $Duration: 1200, x: 0.3, y: 0.3, $Cols: 2, $Rows: 2, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $ChessMode: { $Column: 3, $Row: 12 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
            //Fade out Corners
                , { $Duration: 1200, x: 0.3, y: 0.3, $Cols: 2, $Rows: 2, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $SlideOut: true, $ChessMode: { $Column: 3, $Row: 12 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }

            //Fade Clip in H
                , { $Duration: 1200, $Delay: 20, $Clip: 3, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
            //Fade Clip out H
                , { $Duration: 1200, $Delay: 20, $Clip: 3, $SlideOut: true, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseOutCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
            //Fade Clip in V
                , { $Duration: 1200, $Delay: 20, $Clip: 12, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
            //Fade Clip out V
                , { $Duration: 1200, $Delay: 20, $Clip: 12, $SlideOut: true, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseOutCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
                ];

            var options = {
                $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlayInterval: 1500,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 1,                                //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

                $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)
                $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                $SlideDuration: 800,                                //Specifies default duration (swipe) for slide in milliseconds

                $SlideshowOptions: {                                //[Optional] Options to specify and enable slideshow or not
                    $Class: $JssorSlideshowRunner$,                 //[Required] Class to create instance of slideshow
//                    $Transitions: _SlideshowTransitions,            //[Required] An array of slideshow transitions to play slideshow
                    $TransitionsOrder: 1,                           //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
                    $ShowLink: true                                    //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false
                },

                $ArrowNavigatorOptions: {                       //[Optional] Options to specify and enable arrow navigator or not
                    $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
                    $ChanceToShow: 2                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                },

                $ThumbnailNavigatorOptions: {                       //[Optional] Options to specify and enable thumbnail navigator or not
                    $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always

                    $ActionMode: 1,                                 //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
                    $SpacingX: 8,                                   //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
                    $DisplayPieces: 10,                             //[Optional] Number of pieces to display, default value is 1
                    $ParkingPosition: 360                          //[Optional] The offset position to park thumbnail
                },
                
                $FillMode: 3, //    The way to fill image in slide, 
//                                    0: stretch, 
//                                    1: contain (keep aspect ratio and put all inside slide), 
//                                    2: cover (keep aspect ratio and cover whole slide), 
//                                    4: actual size, 
//                                    5: contain for large image and actual size for small image, default value is 0
               
            };

            var jssor_slider1 = new $JssorSlider$("slider1_container", options);
          function ScaleSlider() {
                var parentWidth = $(\'#slider1_container\').parent().width();
                if (parentWidth) {
                    jssor_slider1.$ScaleWidth(parentWidth);
                }
                else
                    window.setTimeout(ScaleSlider, 30);
            }
            ScaleSlider();

            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            //responsive code end
            
             var $visible = $(\'.fancybox\');
            $("body").on("click",".fancybox",function(e){
                debugger;
                e.preventDefault();
                $.fancybox.open( $visible, {
                    infobar : true,
                    arrows  : true,
                    loop : true,
                    image : {
                        preload : "auto",
                    },
                    thumbs : {
                        autoStart : true
                    }
                }, $visible.index( this ) );

                return false;
            });
', CClientScript::POS_READY);
?>


<!--<div style="position: relative; width: 100%; overflow: hidden;">-->
<div style="position: relative;
            /*width: 100%; */
            height: 300px;"
            class="row1">
<!--    <div style="position: relative; left: 50%; width: 5000px; text-align: center; margin-left: -2500px;">-->


    <div id="slider1_container" class="col-xs-12"
             style="
                    /*position: absolute;*/
                    /*top: 0px;*/
                    /*left: 0px;*/
                    /*width: 100%;*/
                    /*min-width: 300px;*/
                    min-height: 300px;
                    border: 0px solid rgb(237, 237, 237);
                    background: #fff;
                    /*overflow: hidden;*/
                ">

            <!-- Loading Screen -->
            <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                background-color: #000000; top: 0px; left: 0px; width: 100%; height:100%;">
                </div>
                <div style="position: absolute; display: block; background: url(../img/loading.gif) no-repeat center center;
                top: 0px; left: 0px; width: 100%;height:100%;">
                </div>
            </div>

            <!-- Slides Container -->
            <div u="slides"
                 style="cursor: move;
                        position: absolute;
                        left: 0px;
                        top: 0px;
                        /*width: 300px;*/
                        height: 300px;
                        overflow: hidden;
                        background: rgb(104, 104, 104);"
                class="col-xs-12"
            >
                <?php
                if (isset($documents) && is_array($documents)) {
                    foreach ($documents as $document) {
                        $thumb = $document->resize(72, 72, "w", true);
                        $document->resize_quality = 100;
                        $image = $document->resize(425, 300, "h", false);
                        if($document->resized_imagesize){
                            list($width_orig, $height_orig) = $document->resized_imagesize;
                        }
                        $imageBig = $document->getRealPath();
                        ?>
                        <div>
                            <div style="background-image: url('<?=$image ?>');" class="gallery-img-cover"></div>
                            <a u="image" class="fancybox"
                                <?php if(isset($width_orig) && isset($height_orig)){
                                    echo ' data-width="'.$width_orig.'"';
                                    echo ' data-height="'.$height_orig.'"';
                                } ?>
                               data-fancybox="group" href="<?php echo $imageBig; ?>">
                                <img u="image" class="big" src="<?php echo $image; ?>"/>
                            </a>
                            <img u="thumb" src="<?php echo $thumb; ?>"/>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>

            <span u="arrowleft" class="jssora05l" style="top: 45%; left: 8px;"></span>
            <span u="arrowright" class="jssora05r" style="top: 45%; right: 8px"></span>

<!--            <div u="thumbnavigator" class="jssort01" style="left: 0px; bottom: 0px;">-->
<!--                <div u="slides" style="cursor: default;">-->
<!--                    <div u="prototype" class="p">-->
<!--                        <div class=w>-->
<!--                            <div u="thumbnailtemplate" class="t"></div>-->
<!--                        </div>-->
<!--                        <div class=c></div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
        </div>

<!--    </div>-->
</div>


<style>

    a.fancybox{
        cursor: zoom-in;
    }

    @media all and (min-width: 800px) {

        .fancybox-thumbs {
            top: auto;
            width: auto;
            bottom: 0;
            left: 0;
            right : 0;
            height: 95px;
            padding: 10px;
            box-sizing: border-box;
            background: rgba(0, 0, 0, 0.3);
        }

        .fancybox-show-thumbs .fancybox-inner {
            right: 0;
            bottom: 95px;
        }

    }

    body.mobilescreen div#slider1_container {
        min-height: 250px !important;
    }



    /* jssor slider arrow navigator skin 05 css */
    /*
    .jssora05l                  (normal)
    .jssora05r                  (normal)
    .jssora05l:hover            (normal mouseover)
    .jssora05r:hover            (normal mouseover)
    .jssora05l.jssora05ldn      (mousedown)
    .jssora05r.jssora05rdn      (mousedown)
    */
    .jssora05l, .jssora05r {
        display: block;
        position: absolute;
        /* size of arrow element */
        width: 40px;
        height: 40px;
        cursor: pointer;
        background: url(../img/jssor/a17.png) no-repeat;
        overflow: hidden;
    }

    .gallery-img-cover {
        position: absolute;
        display: block;
        top: -13px;
        left: -13px;
        right: -13px;
        bottom: -13px;
        background: center no-repeat;
        background-size: cover;
        -webkit-filter: blur(13px);
        filter: blur(13px);
        opacity: .4;
    }

    .jssora05l {
        background-position: -10px -40px;
    }

    .jssora05r {
        background-position: -70px -40px;
    }

    .jssora05l:hover {
        background-position: -130px -40px;
    }

    .jssora05r:hover {
        background-position: -190px -40px;
    }

    .jssora05l.jssora05ldn {
        background-position: -250px -40px;
    }

    .jssora05r.jssora05rdn {
        background-position: -310px -40px;
    }

    /* jssor slider thumbnail navigator skin 01 css */
    /*
    .jssort01 .p            (normal)
    .jssort01 .p:hover      (normal mouseover)
    .jssort01 .p.pav        (active)
    .jssort01 .p.pdn        (mousedown)
    */

    .jssort01 {
        position: absolute;
        /* size of thumbnail navigator container */
        width: 800px;
        height: 100px;
    }

    .jssort01 .p {
        position: absolute;
        top: 0;
        left: 0;
        width: 72px;
        height: 72px;
    }

    .jssort01 .t {
        position: absolute;
        top: 0;
        left: 0;
        /*width: 100%;*/
        height: 100%;
        border: none;
    }

    .jssort01 .w {
        position: absolute;
        top: 0px;
        left: 0px;
        width: 100%;
        height: 100%;
    }

    .jssort01 .c {
        position: absolute;
        top: 0px;
        left: 0px;
        width: 68px;
        height: 68px;
        border: #000 2px solid;
        box-sizing: content-box;
        background: url(../img/jssor/t01.png) -800px -800px no-repeat;
        _background: none;
    }

    .jssort01 .pav .c {
        top: 2px;
        _top: 0px;
        left: 2px;
        _left: 0px;
        width: 68px;
        height: 68px;
        border: #000 0px solid;
        _border: #fff 2px solid;
        background-position: 50% 50%;
    }

    .jssort01 .p:hover .c {
        top: 0px;
        left: 0px;
        width: 70px;
        height: 70px;
        border: #fff 1px solid;
        background-position: 50% 50%;
    }

    .jssort01 .p.pdn .c {
        background-position: 50% 50%;
        width: 68px;
        height: 68px;
        border: #000 2px solid;
    }

    .slider_wrapper {
        border-bottom: 1px dashed #ddd;
        padding-bottom: 15px;
        display: inline-block;
        width: 100%;
    }

    * html .jssort01 .c, * html .jssort01 .pdn .c, * html .jssort01 .pav .c {
        /* ie quirks mode adjust */
        width /**/: 72px;
        height /**/: 72px;
    }
</style>
    