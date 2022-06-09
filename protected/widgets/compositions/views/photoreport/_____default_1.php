
    <div class="<?php echo $this->wrapper_class; ?>" style="padding: 0px 30px;">
        <div class="section row entries bg-primary section-no-margin-bottom">
            <?php 
                if(isset ($photoreportModels))
                {
                    foreach ($photoreportModels as $key=>$data) {
                        if($key==0){ 
                            $this->render('//main/_view', array('data'=>$data,"thumbWidth"=>389, "thumbHeight"=>439, 'cssClass'=>"col-xs-6 col-sm-12 col-md-6 col-lg-4 colheight-sm-1 colheight-md-2 colheight-lg-2 colheight-xl-2"));
                        }elseif($key==1){ 
                            $this->render('//main/_view', array('data'=>$data,"thumbWidth"=>295, "thumbHeight"=>220, 'cssClass'=>"col-xs-6 col-md-3 col-lg-2 colheight-sm-1"));
                        }else{ 
                            $this->render('//main/_view', array('data'=>$data,"thumbWidth"=>327, "thumbHeight"=>246, 'cssClass'=>"col-xs-6  col-md-3 col-lg-3 colheight-sm-1"));
                         }
                    } ?>
                    
                    <article class="entry style-grid  hidden-xs style-hero hero-sm-largest type-post col-sm-12 col-md-6 col-lg-2 colheight-sm-1 " style="padding: 0px;">
                                    <header class="entry-header-last">
                                            <?php echo CHtml::link('<span class="text"><span class="icon-camera"></span> '.Yii::t('app', 'more photo_report').'</span>',Yii::app()->createUrl('//catalog/category', array('category_id' => $categoryModel->id)),array('class'=>'banner_link')); ?>
                                    </header>

                                    <figure class="entry-thumbnail">
                                        <!-- to disable lazy loading, remove data-src and data-src-retina -->
                                        <img src=""  width="680" height="452" alt="">
                                    </figure>
                    </article>
                <?php } ?>
        </div>
    </div>
