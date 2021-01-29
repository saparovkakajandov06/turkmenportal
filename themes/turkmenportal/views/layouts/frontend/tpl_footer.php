<!--noindex-->
<?php $this->beginWidget('DNofollowWidget'); ?>

<?php
    if (yii::app()->controller->isMobile() && empty(Yii::app()->request->cookies['downloadApp']->value)){
        $cookie = Yii::app()->request->cookies['downloadApp'];

        $cookie = new CHttpCookie('downloadApp', 'true');


        $cookie->expire = time()+60*60*24*7;


        Yii::app()->request->cookies['downloadApp'] = $cookie;
    }
    if(Yii::app()->controller->isIosDevice()){
        $link = "https://apps.apple.com/us/app/turkmenportal/id1544019509?utm_source=turkmenportal&utm_medium=application&utm_campaign=ios";
    } else {
        $link = "https://play.google.com/store/apps/details?id=com.takykcheshme.turkmenportal&referrer=utm_source%3Dturkmenportal%26utm_medium%3Dapplication%26anid%3Dadmob";
    }
?>
<div class="modal_download_app">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="download_app_block">
                    <a href="#" class="close_btn" onclick="hideModalX();" style="float: right;color: #000;font-size: 25px;">x</a>
                    <br>
                    <div class="d_b_main">
                        <div class="d_b_thumbs">
                            <img src="/themes/turkmenportal/img/tp_logo.png" alt="Turkmenportal logo" class="img-responsive">
                        </div>
                        <div class="d_b_cation">
                            <h3><?=yii::t('app', 'Application Turkmenportal')?></h3>
                        </div>
                        <div class="d_b_description">
                            <p><?=yii::t('app', 'Reading news has become more easier with the Turkmenportal application')?></p>
                        </div>
                    </div>
                    <div class="d_b_btn_block">
                        <a href="<?=$link?>" class="download_btn" onclick="hideModal();" target="_blank">
                            <?=Yii::t('app', 'Download')?>
                        </a>
                        <a href="#" class="close_btn" onclick="hideModal();"><?=Yii::t('app', 'No, Thanks');?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

if  (yii::app()->controller->isMobile()){
    Yii::app()->clientScript->registerScript('scripts_ready','
            
            $(document).ready(function() {
                function showModal(){
                     $(".modal_download_app").delay(3000).show("slide", { direction: "down" },500);  
                }
                    var cookie = getCookie("downloadApp");
                   if  (cookie === "true"){
                        showModal();
                   }            

            });
            
            function hideModal(){
                 setCookie("downloadApp","false");
                 $(".modal_download_app").hide("slide", { direction: "down" },500);
            
            }
            function hideModalX(){
                  setCookieX("downloadApp","false");
                 $(".modal_download_app").hide("slide", { direction: "down" },500);
            }
            
            function getCookie(cname) {
              var name = cname + "=";
              var decodedCookie = decodeURIComponent(document.cookie);
              var ca = decodedCookie.split(\';\');
              for(var i = 0; i <ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == \' \') {
                  c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                  return c.substring(name.length, c.length);
                }
              }
              return "";
            }
            
            function setCookie(cname, cvalue) {
              var d = new Date();
              d.setTime(d.getTime() + (7*24*60*60*1000));
              var expires = "expires="+ d.toUTCString();
              document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            }
            
            function setCookieX(cname, cvalue) {
              var d = new Date();
              d.setTime(d.getTime() + (1*24*60*60*1000));
              var expires = "expires="+ d.toUTCString();
              document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            }
        
        ',CClientScript::POS_END);
}


?>
<footer id="footer" class="footer-area row">

    <div class="footer-top footer-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <img alt="Turkmenportal Logo" class="footer_tp_logo"
                         src="<?php echo Yii::app()->theme->baseUrl; ?>/img/icons/tp_white_logo.png" border="0">
                </div>
                <div class=" col-md-12">
                    <ul class="">
<!--                        <li>--><?php //echo CHtml::link(Yii::t('app', 'Add obyawa'), Yii::app()->createUrl('//item/index')) ?><!--</li>-->
                        <?php
                        $informations = Information::model()->sort_id()->is_bottom()->enabled()->findAll();
                        $i = 0;
                        foreach ($informations as $info) {
                            $i ++;
                            if ($i == 6) break;
                            echo '<li>' . CHtml::link($info->getMixedDescriptionModel()->title, Yii::app()->createUrl('//information/view', array('id' => $info->id))) . '</li>';
                        }
                        ?>
                    </ul>
                    <ul class="second">
                        <?php
                        $i = 0;
                        foreach ($informations as $info) {
                            $i ++;
                            if ($i > 5){
                                echo '<li>' . CHtml::link($info->getMixedDescriptionModel()->title, Yii::app()->createUrl('//information/view', array('id' => $info->id))) . '</li>';
                            }
                        }
                        ?>
                    </ul>
                </div>

                <div class="col-md-12 text-center app_download_img_wrapper">
                    <h3 style="color: #fff;"><?=Yii::t('app', 'Download our app')?></h3>
                    <div class="">
                        <a href="https://play.google.com/store/apps/details?id=com.takykcheshme.turkmenportal&hl=ru&gl=US" target="_blank"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/icons/google.png" alt="" height="40"></a>
                        <a href="https://apps.apple.com/us/app/turkmenportal/id1544019509" target="_blank"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/icons/apple.png" alt="" height="40"></a>
                    </div>
                </div>
                <hr>
                <div class=" col-md-12">
                    <div class="footer_text_cr">
                        <span >
                            <?php echo Yii::t('app', 'footer_copy_right'); ?><br>
                            <?php echo 'Свидетельство о регистрации средства массовой информации <a href="http://www.rkn.gov.ru/mass-communications/reestr/media/?id=617836" style="text-decoration:underline; color:#428bca" rel="nofollow" target="_blank"> ЭЛ № ФС 77 - 68969 от 07.03.2017 г.</a> ';
                            //                                    'выдано Федеральной службой по надзору в сфере связи, информационных технологий и массовых коммуникаций (Роскомнадзор).'
                            ?>
                        </span>
                    </div>
                    <?php
//                    $this->widget('application.widgets.social.SocialIconsWidget', array());
                    ?>
                </div>
                <div class=" col-md-4">

                </div>

                <div class=" col-md-3">
                    <ul class="entries links links-inline">
<!--                            <li>--><?php //echo CHtml::link(Yii::t('app', 'Add obyawa'), Yii::app()->createUrl('//item/index')) ?><!--</li>-->
<!--                        --><?php
//                        $informations = Information::model()->sort_by_order()->is_bottom()->enabled()->findAll();
//                        foreach ($informations as $info) {
//                            echo '<li>' . CHtml::link($info->getMixedDescriptionModel()->title, Yii::app()->createUrl('//information/view', array('id' => $info->id))) . '</li>';
//                        }
//                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class=" " style="margin-bottom: 20px;">
        <!-- Rating Mail.ru counter -->
        <script type="text/javascript">
            var _tmr = window._tmr || (window._tmr = []);
            _tmr.push({id: "2710500", type: "pageView", start: (new Date()).getTime()});
            (function (d, w, id) {
                if (d.getElementById(id)) return;
                var ts = d.createElement("script");
                ts.type = "text/javascript";
                ts.async = true;
                ts.id = id;
                ts.src = "https://top-fwz1.mail.ru/js/code.js";
                var f = function () {
                    var s = d.getElementsByTagName("script")[0];
                    s.parentNode.insertBefore(ts, s);
                };
                if (w.opera == "[object Opera]") {
                    d.addEventListener("DOMContentLoaded", f, false);
                } else {
                    f();
                }
            })(document, window, "topmailru-code");
        </script>
        <noscript>
            <div>
                <img src="https://top-fwz1.mail.ru/counter?id=2710500;js=na"
                     style="border:0;position:absolute;left:-9999px;" alt="Top.Mail.Ru"/>
            </div>
        </noscript>
        <!-- //Rating Mail.ru counter -->
    </div>
</footer>
<?php $this->endWidget(); ?>
<!--/noindex-->
