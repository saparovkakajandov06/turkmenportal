<?php 
    $data=$mainBlogModel; 
?>

<div class="row">
    <div class="col-md-5">
        <div class="main_news_block">
            <span class="media-object responsive" >
                    <?php echo CHtml::link(Chtml::image($data->getThumbPath(334,222,'auto',true),$title), Yii::app()->createUrl("//blog/view", array('id' => $data->id)), array('class'=>"thumb")); ?>
            </span>

            <div>
                <h1  class="blog_header"> 
                    <?php
                        $title = $data->getTitle();
                        echo CHtml::link(Yii::app()->controller->truncate($title, 15, 200), Yii::app()->createUrl("//blog/view", array('id' => $data->id)), array('alt' => $title, 'rel' => 'bookmark'));
                    ?>
                </h1>
    
                <div class="description_text main_item" itemprop="articleBody">
                    <?php
                        echo $data->getDescription();
                    ?>
                </div>
                
<!--               <div class="article_stats">
                       <time class="article_header_date" itemprop="dateCreated" datetime="<?php echo Yii::app()->controller->dateToW3C($data->date_added); ?>"><?php echo Yii::app()->controller->renderDateTime($data->date_added); ?></time>
                       <div class="post-item__comments"><i class="icon-comment"></i><span> <?php echo $data->getCommentCount(); ?> </span></div>
                       <div class="post-item__views"><i class="icon-eye-open"></i><span><?php echo $data->visited_count; ?></span></div>
                       <div class="post-item__comments"><i class="icon-thumbs-up"></i><span><?php echo isset($data->like_count) ? $data->like_count : 0; ?></span></div>
                       <div class="post-item__comments"><i class="icon-thumbs-down"></i><span><?php echo isset($data->dislike_count) ? $data->dislike_count : 0; ?></span></div>
               </div>-->
            </div>
       </div>
   </div>            

    <div class="col-md-7">
        <?php
        $this->render('/tabs/_most_recent_news', array('blogModels'=>$newestBlogModels)); 

//        
//        $this->widget('bootstrap.widgets.TbTabs', array(
//            'type' => 'tabs',
//            'tabs' => array(
//                    array('label' => Yii::t('app','newest'), 'content' => $this->render('/tabs/_most_resent_news', array('blogModels'=>$newestBlogModels), true), 'active' => true),
////                    array('label' => Yii::t('app','popular'), 'content' => $this->render('/tabs/_most_popular_news', array('blogModels'=>$popularBlogModels), true)),
////                    array('label' => 'Inner', 'content' => $this->render('_inner_news', NULL, true)),
////                    array('label' => 'Abroad', 'content' => $this->render('_abroad_news', NULL, true)),
//                ),
//            'htmlOptions'=>array('id'=>'index_news'),
//            )
//        );
//        
      ?>
        
    </div>
</div>
