<?php
    $categoryModel = Category::model()->findByAttributes(array('code' => 'fotoreport'));
?>

<div class="box_header_index">
    <div class="header">
        <?php echo CHtml::link($categoryModel->name, Yii::app()->createUrl('//blog/category', array('category_id' => $categoryModel->id)), array('class' => "headerColor")); ?>
    </div>
</div>

<div class=" hidden-xs">
        <div class="section  entries bg-primary section-no-margin-bottom">
            <?php 
                $mainBlogModels=Blog::model()->photoreport()->sort_newest()->sort_by_order()->findAll(array('limit'=>3));
                if(isset ($mainBlogModels))
                {
                    foreach ($mainBlogModels as $key=>$mainBlogModel) { ?>
                        <article class="entry vertical style-grid style-hero type-post col-md-6  colheight-sm-1 colheight-md-1 colheight-lg-1 colheight-xl-1">
                            <header class="entry-header">
                                <h5 class="entry-title">
                                    <?php echo CHtml::link($mainBlogModel->getTitle(),Yii::app()->createUrl('//blog/view',array('id'=>$mainBlogModel->id)),array('class'=>'banner_link'));?>
                                </h5>
                            </header>
                            <figure class="entry-thumbnail">
                                <?php
                                    echo CHtml::link(
                                    CHtml::image($mainBlogModel->getThumbPath(295,220,'auto',true), $mainBlogModel->getTitle(),
                                              array(
                                                  'data-src'=>$mainBlogModel->getThumbPath(295,220,'auto',true),
                                                  'data-src-retina'=>$mainBlogModel->getThumbPath(295,220,'auto',true),
                                              )
                                          ),
                                          Yii::app()->createUrl('//blog/view',array('id'=>$mainBlogModel->id)),array('class'=>"overlay overlay-primary"));
                                  ?>
                            </figure>
                             <span class="c-photo__text__inner__gallcount">
                                        <span class="c-photo__text__inner__gallcount__text"><?php echo count($mainBlogModel->documents); ?></span>
                                    </span>
                        </article>
                       <?php  }
                } ?>
                    
         
    </div>
</div>
