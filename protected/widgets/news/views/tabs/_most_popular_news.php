<?php

//    $blogModels=Blog::model()->most_popular()->sort_by_order()->findAll(array('limit'=>5,'condition'=>'t.date_modified > '.  strtotime('-4 week')));
    foreach ($blogModels as $key=>$data) { 
        $data=  Blog::model()->findByPk($data->id);
        ?>
        
        <div class="list-item ">
      
            <div class="entry-title">
                <?php
                $title = $data->getTitle();
                echo CHtml::link(Yii::app()->controller->truncate($title, 15, 200), Yii::app()->createUrl("//blog/view", array('id' => $data->id)), array('alt' => $title,'title' => $title, 'rel' => 'bookmark'));
                ?>
            
            
                <div class="article_stats">
                    <time class="article_header_date" itemprop="dateCreated" datetime="<?php echo Yii::app()->controller->dateToW3C($data->date_added); ?>"><?php echo Yii::app()->controller->renderDateTime($data->date_added); ?></time>
                    <div class="post-item__views"><i class="icon-eye-open"></i><span><?php echo $data->visited_count; ?></span></div>
                </div>
            </div>
            
        </div>
<?php }?>