<?php
    $modelCategory = $model->category;
    $breadcrumbs=array();
    if(isset($modelCategory) && isset($modelCategory->parent)){
        $breadcrumbs[$modelCategory->parent->getMixedDescriptionModel()->name]= array('//catalog/category', 'category_id' => $modelCategory->parent_id);
        $breadcrumbs[]=$modelCategory->getMixedDescriptionModel()->name;
    }
    $this->breadcrumbs = $breadcrumbs;
    $this->pageTitle=$model->getMixedDescriptionModel()->title; 
?>


<div class="row">
    <div class="col-sm-3 hidden-xs">
        <?php
            $this->renderPartial('_sub_categories', array('modelCategory' => $modelCategory->parent));
        ?>
    </div>
    <div class="col-sm-9">
        <h1 class="blog_header"><?php echo $model->getMixedDescriptionModel()->title; ?></h1>
         <div class="article_stats">
            <div class="post-item__comments"><i class="icon-comment"></i><span> <?php echo $model->getCommentCount(); ?> </span></div>
            <div class="post-item__views"><i class="icon-eye-open"></i><span><?php echo $model->views; ?></span></div>
        </div>
     
        
        <?php
         $attributes = array(
//                     array(
//                            'name' => 'documents.name',
//                            'value' => $model->getThumbAsGallery(),
//                            'type'=>'raw',
//                            'filter' => false,
//                            'htmlOptions' => array('style' => 'width:100px; padding-right:10px;')
//                        ),
//                    array(
//                        'name' => 'region_id',
//                        'value' => $data->getRegionName(),
//                        'visible'=>isset($data->getRegionName()),
//                    ),
                    array(
                        'label' => 'description',
                        'type'=>'raw',
                        'value' => $model->getMixedDescriptionModel()->description,
                        'visible'=>  strlen(trim($model->getMixedDescriptionModel()->description))>0,
                    ),
                  
                    array(
                        'label' => $model->getAttributeLabel('price'),
                        'value' => $model->price,
                        'visible'=> (isset($model->price) && strlen(trim($model->price))>1),

                    ),
                    array(
                        'label' => $model->getAttributeLabel('address'),
                        'value' => $model->address,
                        'visible'=> (isset($model->address) && strlen(trim($model->address))>0),

                    ),
                    array(
                        'label' => $model->getAttributeLabel('phone'),
                        'value' => $model->phone,
                        'visible'=> (isset($model->phone) && strlen(trim($model->phone))>0),

                    ),
                    array(
                        'label' => $model->getAttributeLabel('mail'),
                        'value' => $model->mail,
                        'visible'=> (isset($model->mail) && strlen(trim($model->mail))>0),
                    ),
                    array(
                        'label' => $model->getAttributeLabel('web'),
                        'value' => CHtml::link($model->web,'http://'.$model->web,array('rel'=>'nofollow')),
                        'type'=>'raw',
                        'visible'=> (isset($model->web) && strlen(trim($model->web))>0),
                    ),
            );
            ?>
        
            
           
        
            <div class="row">
                <div class="col-md-3">
                    <span class="image catalog_image">
                        <?php
                            echo $model->getThumbAsGallery(150,150,600,600,'auto');
    //                        if(isset($model->documents) && count($model->documents)>0)
    //                        {
    //                            foreach ($model->documents as $document) {
    //                                echo CHtml::image($document->resize(150,150));
    //                            }
    //                        }
                        ?>
                    </span>
                </div>
                <div class="col-md-9 catalog-detail">
                    <div class="article_text catalog" itemprop="articleBody">
                        <?php
                            echo $model->getMixedDescriptionModel()->content; 
                        ?>
                        
                    </div>
                    <?php
                        $this->widget('bootstrap.widgets.BootDetailView', array(
                            'data' => $model,
                            'attributes'=>$attributes,
                            )
                        );

                    ?>
                    <?php
                        $documents=$model->files;
                        if(isset($documents) && count($documents)>0){ ?>
                        <table class="detail-view table table-striped table-condensed" id="yw1">
                            <thead>
                                <tr><td colspan="2">
                                    <?php echo Yii::t('app', 'related_documents'); ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($documents as $docs){ ?>
                                    <tr class="odd">
                                        <th><?php echo CHtml::link($docs->name,$docs->getUploadedPath($docs->path),array("download"=>$docs->name, "target"=>"_blank")); ?> </th>
                                        <td> <?php echo $this->filesize_formatted($docs->getUploadedPath($docs->path)); ?></td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>

                    <?php }?>
                </div>
            </div>
             
            <!--noindex-->
            <?php $this->beginWidget('DNofollowWidget'); ?>
            <div class="comments__head"><?php echo Yii::t('app', 'Related'); ?></div>
            <div class="row">
                    <?php
                    $this->widget('bootstrap.widgets.BootListView', array(
                        'dataProvider' => $model->searchByCategory($modelCategory->id,6,false,array($model->id)),
                        'itemView' => '_listview',
                        'summaryText' => '',
                        'emptyText' => '',
                    ));
                    ?>
            </div>
            <?php
                $this->renderPartial('//comments/add_comment',array('related_relation' => 'catalogs','related_relation_id'=>$model->getPrimaryKey()));
            ?>
            <?php $this->endWidget(); ?>
            <!--/noindex-->
    </div>
</div>




