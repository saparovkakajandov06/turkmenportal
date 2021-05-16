
<article class="type-post style-media-list media <?php echo $this->item_class; ?> colheight-index">
    <div class="inner_block">
        <?php 
        if(isset($this->show_photo) && $this->show_photo==true){ ?>
            <div class="pull-left">
                <?php echo CHtml::link(Chtml::image($data->getThumbPath(90,65,'w',true),''), $data->getUrl(), array( 'class'=>"thumb")); ?>
            </div>
        <?php }?>

        <div class="media-body">
            
                <div class="entry-title right-news">
                    <?php 
                        $autoName="";
                        $autoModel=$data->automodel;
                        if(isset($autoModel)){
                            $autoMake=$autoModel->automake;
                            if(isset($autoMake))
                                $autoName=$autoMake->name." ";
                            
                            $autoName.=$autoModel->name;
                        }
                        echo CHtml::link($autoName, Yii::app()->createUrl("//auto", array('Auto[make_id]' => $data->automodel->make_id)));
                    ?>
                </div>

                <div class="entry-title">
                    <?php
                        $title = $data->description;
                        echo CHtml::link(Yii::app()->controller->truncate($title, 17, 170), Yii::app()->createUrl("//auto/view", array('id' => $data->id)), array('alt' => $title, 'rel' => 'bookmark'));
                    ?>

                    <div class="article_stats">
                        <time class="article_header_date" itemprop="dateCreated" datetime="<?php echo Yii::app()->controller->dateToW3C($data->date_added); ?>"><?php echo Yii::app()->controller->renderDateTime($data->date_added); ?></time>
                        <div class="post-item__views"><i class="icon-eye-open"></i><span><?php echo $data->views; ?></span></div>
                    </div>
            </div>
        </div>
    </div>
</article>