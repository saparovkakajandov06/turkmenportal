
<article class="entry type-post col-sm-6 col-xs-6 col-md-6 col-lg-2 colheight-md-1  colheight-sm-3 ">
    <?php echo CHtml::link(CHtml::image($data->getThumbPath(165,115,'w',true),$title), Yii::app()->createUrl("//compositions/view", array('id' => $data->id)), array( 'class'=>"thumb")); ?>
    
        <div class="entry-title bottom-news">
            <?php
                $title = $data->getTitle();
                echo CHtml::link(Yii::app()->controller->truncate($title, 17, 170), Yii::app()->createUrl("//compositions/view", array('id' => $data->id)), array('alt' => $title, 'rel' => 'bookmark'));
            ?>
            
          
        </div>

    
        <div class="article_stats">
            <div class="article_category">
                <?php 
                    if(isset($data->category_id))
                        echo CHtml::link($data->getMixedCategoryName(), Yii::app()->createUrl("//compositions/index", array('category_id' => $data->category_id)), array('rel' => 'bookmark')); 
                ?>
            </div>
        </div>
</article>


