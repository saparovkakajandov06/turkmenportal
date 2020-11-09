<div class="row hidden-xs">

    <div class="col-md-9 bg-base col-lg-9 col-xl-9">
        <div class="section row entries bg-primary section-no-margin-bottom">
            <?php 
                $mainBlogModels=Blog::model()->main()->sort_newest()->sort_by_order()->findAll(array('limit'=>5));
                if(isset ($mainBlogModels))
                {
                    foreach ($mainBlogModels as $key=>$mainBlogModel) {
                        if($key==0)
                        { ?>
                              <article class="entry style-grid style-hero hero-sm-largest type-post col-sm-12 col-md-6 col-lg-4 colheight-sm-1 colheight-md-2 colheight-lg-2 colheight-xl-2">
                                    <header class="entry-header">
                                        <h3 class="entry-title">
                                            <?php echo CHtml::link($mainBlogModel->getMixedDescriptionModel()->title,Yii::app()->createUrl('//blog/view',array('id'=>$mainBlogModel->id)),array('class'=>'banner_link')); ?>
                                            <span class="banner_description"><?php echo CHtml::link($mainBlogModel->getMixedDescriptionModel()->description,Yii::app()->createUrl('//blog/view',array('id'=>$mainBlogModel->id))); ?></span>
                                        </h3>
                                    </header>

                                    <figure class="entry-thumbnail">
                                        <?php
                                          echo CHtml::link('',Yii::app()->createUrl('//blog/view',array('id'=>$mainBlogModel->id),array('class'=>"overlay overlay-primary") ));
                                        ?>

                                        <!-- to disable lazy loading, remove data-src and data-src-retina -->
                                        <img src="<?php echo $mainBlogModel->getThumbPath(); ?>" data-src="<?php echo $mainBlogModel->getThumbPath(680,452,'',true); ?>" data-src-retina="<?php echo $mainBlogModel->getThumbPath(1024,680); ?>" width="680" height="452" alt="">
                                        <noscript>
                                            <img src="<?php echo $mainBlogModel->getThumbPath(680,452,'',true); ?>" alt="">
                                        </noscript>
                                    </figure>
                                </article>
                    <?php }else{ ?>
                          
                        <article class="entry style-grid style-hero type-post col-md-6 col-lg-4 colheight-sm-1">
                            <header class="entry-header">
                                <h5 class="entry-title">
                                    <?php
                                      echo CHtml::link($mainBlogModel->getMixedDescriptionModel()->title,Yii::app()->createUrl('//blog/view',array('id'=>$mainBlogModel->id)),array('class'=>'banner_link'));
                                    ?>
                                    <span class="banner_description"><?php echo CHtml::link($mainBlogModel->getMixedDescriptionModel()->description,Yii::app()->createUrl('//blog/view',array('id'=>$mainBlogModel->id))); ?></span>
                                </h5>
                            </header>

                            <figure class="entry-thumbnail">
                                <?php
                                  echo CHtml::link('',Yii::app()->createUrl('//blog/view',array('id'=>$mainBlogModel->id),array('class'=>"overlay overlay-primary") ));
                                ?>

                                <!-- to disable lazy loading, remove data-src and data-src-retina -->
                                <img src="<?php echo $mainBlogModel->getThumbPath(); ?>" data-src="<?php echo $mainBlogModel->getThumbPath(295,220,'',true); ?>" data-src-retina="<?php echo $mainBlogModel->getThumbPath(1024,680); ?>" width="295" height="220" alt="">
                                <!--fallback for no javascript browsers-->
                                <noscript>
                                <img src="<?php echo $mainBlogModel->getThumbPath(295,220,'',true); ?>" alt="">
                                </noscript>
                            </figure>
                        </article>
                       <?php  }
                    }
                }
            ?>
        </div>
    </div>
    <div class="sidebar col-md-3 col-lg-3 col-xl-3 pull-right first-banner">
        <?php
            $this->widget('BannersWidget', array(
                    'type' => 'bannerA',
                    'outer_css_class' => 'colheight-sm-2 hidden-xs',
                    'outer_css_id' => 'banner2',
            ));
        ?>
    </div>
</div>