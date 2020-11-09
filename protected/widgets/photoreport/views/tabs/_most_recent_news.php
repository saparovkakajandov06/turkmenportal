<?php
    
//    $blogModels=Blog::model()->sort_newest()->sort_by_order()->findAll(array('limit'=>5));
    foreach ($blogModels as $key=>$data) { ?>
        
        <div class="list-item ">
            <div class="entry-title">
                <?php
                $title = $data->getTitle();
                if(strlen($title)>5) { ?>
                    <span class="entry-date"> <time datetime="<?php echo Yii::app()->controller->dateToW3C($data->date_added); ?>"> <?php echo Yii::app()->controller->renderDate($data->date_added); ?></time></span>
                <?php }
                echo CHtml::link(Yii::app()->controller->truncate($title, 15, 200), $data->url, array('alt' => $title, 'rel' => 'bookmark'));
                ?>
            
            
<!--                <div class="article_stats">
                    <time class="article_header_date" itemprop="dateCreated" datetime="<?php echo Yii::app()->controller->dateToW3C($data->date_added); ?>"><?php echo Yii::app()->controller->renderDateTime($data->date_added); ?></time>
                    <div class="post-item__views"><i class="icon-eye-open"></i><span><?php echo $data->visited_count; ?></span></div>
                </div>-->
            </div>
        </div>
<?php }?>