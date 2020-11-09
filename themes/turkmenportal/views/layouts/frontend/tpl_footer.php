<!--noindex-->
<?php $this->beginWidget('DNofollowWidget'); ?>
<footer id="footer" class="footer-area row">

    <div class="footer-top footer-section">
        <div class="container">
            <div class="row">
                <div class=" col-md-5">
                    <div class="footer_logo">
                        <img alt="Turkmenportal Logo"
                             src="<?php echo Yii::app()->theme->baseUrl; ?>/img/icons/footer_tp.png" border="0">
                    </div>
                    <div class="footer_text_cr">
                        <span> 2011-<?php echo date('Y') . ' ' . Yii::t('app', 'year'); ?>
                            <?php echo Yii::t('app', 'footer_copy_right'); ?>
                            <?php echo '</br>Свидетельство о регистрации средства массовой информации <a href="http://www.rkn.gov.ru/mass-communications/reestr/media/?id=617836" style="text-decoration:underline; color:#428bca" rel="nofollow" target="_blank"> ЭЛ № ФС 77 - 68969 от 07.03.2017 г.,</a> ';
                            //                                    'выдано Федеральной службой по надзору в сфере связи, информационных технологий и массовых коммуникаций (Роскомнадзор).'
                            ?>
                        </span>
                    </div>
                    <?php
                    $this->widget('application.widgets.social.SocialIconsWidget', array());
                    ?>
                </div>
                <div class=" col-md-4">

                </div>

                <div class=" col-md-3">
                    <ul class="entries links links-inline">
                        <li><?php echo CHtml::link(Yii::t('app', 'Add obyawa'), Yii::app()->createUrl('//item/index')) ?></li>
                        <?php
                        $informations = Information::model()->sort_by_order()->is_bottom()->enabled()->findAll();
                        foreach ($informations as $info) {
                            echo '<li>' . CHtml::link($info->getMixedDescriptionModel()->title, Yii::app()->createUrl('//information/view', array('id' => $info->id))) . '</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom footer-section">
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
