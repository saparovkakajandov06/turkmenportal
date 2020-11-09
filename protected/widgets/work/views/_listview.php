
<article class="type-post style-media-list media <?php echo $this->item_class; ?> colheight-index">
    <div class="inner_block">
        <div class="media-body">
            
                    <div class="entry-title right-news">
                        <?php 
                            $category_text="";
                            $profession=$data->material->getMixedProfessionName();
                            $type=$data->material->getType();
                            if(isset($type)){
                                $category_text=$type." ";
                            }
                            if(isset($profession)){
                                $category_text.=$profession;
                            }

                            echo CHtml::link($category_text, $data->material->url); 
                        ?>
                    </div>
                    
            
                    <div class="entry-title">
                        <?php 
                        $title=$data->material->description;
                        $title=  CHtml::encode($title);
                        echo CHtml::link(Yii::app()->controller->truncate($title,15,300), $data->material->url, array('alt'=>$title,'title' => $title,'rel' => 'bookmark')); ?>
                 
                    <div class="article_stats">
                        <time class="article_header_date" itemprop="dateCreated" datetime="<?php echo Yii::app()->controller->dateToW3C($data->date_added); ?>"><?php echo Yii::app()->controller->renderDateTime($data->date_added); ?></time>
                        <div class="post-item__views"><i class="icon-eye-open"></i><span><?php echo $data->views; ?></span></div>
                    </div>
                </div>
        </div>
    </div>
</article>