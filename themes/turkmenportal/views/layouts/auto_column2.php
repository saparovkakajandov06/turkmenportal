<?php /* @var $this Controller */ ?>
<?php $themeUrl = Yii::app()->theme->baseUrl; ?>

<?php $this->beginContent('//layouts/main'); ?>
              
		<div id="main" class="container">
			<div id="content" class="content section ">
                            <div class="row mobile_block inned">
                                    <div class="col-md-8 bg-base col-lg-8 col-xl-9">
                                        <?php echo $content; ?>
                                    </div>

                                    <div class="sidebar col-md-4 col-lg-4 col-xl-3">
                                            <?php //require_once('frontend/tpl_col2r_sidebar.php')?>
                                    </div>
                            </div>
                            
			</div>
		</div>
                <?php Yii::beginProfile('headerId'); ?>
                    <?php require_once('frontend/tpl_header.php')?>
                <?php Yii::endProfile('headerId'); ?>

                <?php require_once('frontend/tpl_footer.php')?>
<?php $this->endContent(); ?>

                
                