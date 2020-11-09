<?php /* @var $this Controller */ ?>
<?php $themeUrl = Yii::app()->theme->baseUrl; 
    Yii::app()->clientscript->registerCssFile( $themeUrl . '/css/backend/backend.css?v=1.1');
?>


<?php $this->beginContent('//layouts/main'); ?>
<?php require_once('backend/tpl_header.php')?>
<div id="main" class="container admin">
    <div id="content" class="content section row">

        <div class="col-md-2">
            <?php require_once('backend/tpl_col2r_sidebar.php') ?>
        </div>

        <div class="col-md-10 admin_content">
            <div class="row">
                <?php //require_once('backend/tpl_navigation_admin.php') ?>
                <div class="admin_panel">
                    <div class="page_menu">
                        <div class="col-md-12">
                            <?php
                            foreach ($this->menu as $button) {
                                if (isset($button['htmlOptions']) && is_array($button['htmlOptions'])) {
                                    $button['htmlOptions']['class'] = $button['htmlOptions']['class'] . " sub-nav-button";
                                }else
                                    $button['htmlOptions'] = array('class' => "sub-nav-button");
                                if (!isset($button['type']))
                                    $button['type'] = 'default';
//                              $button['htmlOptions']['disabled']=!$this->checkRightsFromUrl($button['url']);
                                $this->widget('bootstrap.widgets.TbButton', $button);
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <?php echo $content; ?>
                </div>
            </div>
        </div>



    </div>
</div>
<?php //require_once('backend/tpl_footer.php')?>
<?php $this->endContent(); ?>