
<div data-key="<?php echo $data->id; ?> ">    <!--if model->status == 1-->
    <div class="client-item-wrap row">
        <div class="client-item col-md-12 default">
            <div class="col-md-4 client-image">
            
            <?php if(isset($this->show_photo) && $this->show_photo==true){ ?>
                <span class="media-object pull-left">
                    <?php echo CHtml::link(CHtml::image($data->getThumbPath(230,150),$title), Yii::app()->createUrl("//catalog/view", array('id' => $data->id)), array( 'class'=>"thumb")); ?>
                </span>
            <?php }?>
            </div>

            <div class="col-md-8 client-details">
                <div class="client-title">
                    <h4 class="margin-right-md">
                        <?php
                          $title=$data->getTitle(); 
//                          $title=  str_replace($title, "\\", "");
                          echo CHtml::link(Yii::app()->controller->truncate($title,15,450), $data->url, array('alt'=>$title,'rel' => 'bookmark')); 
                        ?>
                    </h4>
                    
                    <span class="text-muted catalog-category">
                        <?php
                            echo $data->category->name;
                        ?>
                    </span>
                </div>
                
                
                <div class="client-details-item">
                    <?php
                        echo $data->description;
                    ?>
                    
                    <?php if(isset($data->address) && strlen(trim($data->address))>2){ ?>
                    <i class="fa fa-map-marker"></i>
                    <b>
                        <?php
                            echo $data->address;
                        ?>                      
                    </b>
                    <?php } ?>
                </div>
                
                <div class="client-details-item">
                    <?php if(isset($data->phone) && strlen(trim($data->phone))>2){ ?>
                        <i class="fa fa-phone"></i>
                        <b><?php echo $data->phone; ?></b><br>
                    <?php } ?>
                </div>
            </div>
            
            <div class="row client-media-links">
                <div class="col-md-12 text-right text-xxl">
                    <!--<a href="/index.php?r=client%2Fabout&amp;id=108">О нас</a>-->
                    <!--<a href="/index.php?r=client%2Freview&amp;id=108">Отзывы</a>-->

                </div>
            </div>
        </div>

    </div>
    <div class="">
        <div class="col-md-12">
            <hr>
        </div>
    </div>
</div>