<?php
$this->breadcrumbs = array(
    $modelCategory->name,
);


if(!isset($this->menu) || $this->menu === array())
$this->menu=array(
	array('label'=>Yii::t('app', 'Create'), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage'), 'url'=>array('admin')),
);
?>

<h1><?php echo $modelCategory->name; ?></h1>


<div class="row">

   <div class="col-sm-3">
       <?php
            $this->renderPartial('//category/_sub_categories', array('modelCategory' => $modelCategory));
       ?>
    </div>
    
    
    <div class="col-sm-9">
        <?php 
        
             $this->widget('bootstrap.widgets.BootGridView', array(
            'id' => 'blog-grid',
            'type'=>'striped bordered condensed',
            'dataProvider' => $modelBlog->searchBlogsWithCategories(),
            'summaryText'=>Yii::t('app','Displaying {start}-{end} of {count} result(s).'),
            'pagerCssClass'=>"pagination",
            'pager' => array('header' => '',
                         'maxButtonCount' => $this->maxButtonCount,
                         'cssFile' => false,
                         'htmlOptions'=>array('class'=>'pagination pull-right'),
                         'prevPageLabel' => '<i class="fa fa-chevron-left"></i>',
                         'nextPageLabel' => '<i class="fa fa-chevron-right"></i>',
                         'firstPageLabel' => Yii::t('app','$LNG_FIRST'),
                         'lastPageLabel' => Yii::t('app','$LNG_LAST'),
            ),
            'columns' => array(
                    array(
                                'name' => 'categories.name',
                                'value' => '$data->category_name',
                    ),
                
                    array(
                                'name' => 'image',
                                'value' => '$data->image',
                                'filter' => false,
                        ),
                    array(
                                'name' => 'descriptions.title',
                                'value' => '$data->title',
                    ),
//                    array(
//                            'name' => 'descriptions.description',
//                            'value' => '$data->description',
//                        ),
                    'edited_username',
                    'date_modified',
            array(
                'class'=>'bootstrap.widgets.BootButtonColumn',
                'template' => '{view}',
                'htmlOptions'=>array('style'=>'width: 85px; text-align:right;'),
                ),
            ),
            ));
        
        
        ?>

    </div>
</div>