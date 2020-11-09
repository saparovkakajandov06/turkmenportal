<!--noindex-->
<?php $this->beginWidget('DNofollowWidget'); ?>

<div id="lenta-news-wrapper">

    <?php
    if ($this->ajax == true) {
        echo '<div id="lenta_wrapper"></div>';
        Yii::app()->clientScript->registerScript("poll_ajax_notifications",
            'function getNotification(){' .
            CHtml::ajax(
                array(
                    'url' => array("//widgets/partial"),
                    'dataType' => 'html',
                    'type' => 'POST',
                    'update' => '#lenta_wrapper',
                    'data' => array(
                        "widget" => 'application.widgets.news.LentaNewsWidget',
                        'count' => $this->count,
                        'category_code' => $this->category_code,
                        'item_class' => $this->item_class,
                        'show_all' => $this->show_all,
                    )
                )
            ) . ' 
            }
            timer = setTimeout("getNotification()", 1000);',
            CClientScript::POS_END);
    } else { ?>
        <div class="">
            <h4><?php echo Yii::t('app', 'News widget'); ?></h4>
        </div>
        <?php
//        $popularDataProvider = $dataProvider;
//        $recentDataProvider = $dataProvider;
        $tabs = array();
        $tabs[] = array('id' => 'most_read', 'label' => Yii::t('app', 'Trend news'), 'content' => $this->render('/lenta/popular', array('dataProvider' => $popularDataProvider), true, false), 'active' => true);
        $tabs[] = array('id' => 'recent', 'label' => Yii::t('app', 'Lenta News'), 'content' => $this->render('/lenta/recent', array('dataProvider' => $recentDataProvider), true, false));

        $this->widget('bootstrap.widgets.TbTabs', array(
            "id" => "news-list-tabs",
            "type" => "tabs",
            'tabs' => $tabs
        ));
    }
    ?>
</div>

<?php $this->endWidget(); ?>
<!--/noindex-->