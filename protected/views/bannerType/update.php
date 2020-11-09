<?php
$this->breadcrumbs = array(
    Yii::t('app', 'Banner Types') => array('index'),
    Yii::t('app', $model->id) => array('view', 'id' => $model->id),
    Yii::t('app', 'Update'),
);
if (!isset($this->menu) || $this->menu === array())
    $this->menu = array(
        array('label' => Yii::t('app', 'Delete'), 'url' => '#', 'htmlOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
        array('label' => Yii::t('app', 'Create'), 'url' => array('create')),
        array('label' => Yii::t('app', 'Manage'), 'url' => array('admin')),
    );
?>

    <div class="col-md-12"><h1> <?php echo Yii::t('app', 'Update'); ?><?php echo $model->id; ?> </h1></div>

<?php
$this->renderPartial('_form', array('model' => $model));

if (isset($model) && isset($model->id)) {
    ?>

    <div class=" col-md-12">
        <div class="tab-content"
             style="margin-top: 95px; border-top: 1px solid #ddd; background: #FDFDFD; margin-bottom: 50px;">
            <div class="relations last ">
                <h4><?php echo Yii::t('app', 'Banners'); ?></h4>
                <?php
                $columns = array(
                    array(
                        'name' => 'image',
                        'type' => 'raw',
                        'value' => 'CHtml::image($data->getThumbPath(150,120,"auto",true),null,array("style"=>"max-width:150px"))',
                        'htmlOptions' => array('style' => 'width:150px;'),
                    ),
                    'description',
                    'url',
                    'view_count',
                    'click_count',

                    'date_added',
                    'date_expire',
                    array (
                        'name' => 'status',
                        'value' => '$data->getStatusText()',
                        'type' => 'raw',
                    ),
                    array(
                        'class' => 'bootstrap.widgets.BootButtonColumn',
                        'template' => "{update} {delete}",
                        'htmlOptions' => array('style' => 'width: 85px; text-align:right;'),
                        'buttons' => array(
                            'update' => array(
                                'label' => '<i class="fa fa-pencil"></i>',
                                'url' => 'Yii::app()->createUrl("//bannerType/update",array("id"=>$data->type,"banner_id"=>$data->primaryKey))',
                            ),
                            'delete' => array(
                                'label' => '<i class="fa fa-trash"></i>',
                                'url' => 'Yii::app()->createUrl("//banner/delete",array("id"=>$data->primaryKey))',
                            ),
                        )
                    ),
                );

                if ($model->type == BannerType::TYPE_ADSENSE) {
                    $columns[0] = array(
                        'name' => 'format_type',
                        'type' => 'raw',
                        'value' => '$data->getFormatTypeText()',
                    );
                    $columns[2] = array(
                        'name' => 'adsense_code',
                        'type' => 'raw',
                        'value' => 'CHtml::encode($data->adsense_code)',
                    );

                }


                $this->widget('bootstrap.widgets.BootGridView', array(
                    'dataProvider' => $bannerGridModel->search(),
                    'template' => '{items}',
                    'id' => 'banner-grid',
                    'type' => 'striped bordered condensed',
                    'emptyText' => Rights::t('core', 'This item has no parents.'),
                    'htmlOptions' => array('class' => 'grid-view parent-table mini'),
                    'pagerCssClass' => "pagination",
                    'pager' => array('header' => '',
                        'maxButtonCount' => $this->maxButtonCount,
                        'cssFile' => false,
                        'htmlOptions' => array('class' => 'pagination pull-right'),
                        'prevPageLabel' => '<i class="fa fa-chevron-left"></i>',
                        'nextPageLabel' => '<i class="fa fa-chevron-right"></i>',
                        'firstPageLabel' => Yii::t('app', '$LNG_FIRST'),
                        'lastPageLabel' => Yii::t('app', '$LNG_LAST'),
                    ),
                    'columns' => $columns
                ));
                ?>
            </div>


            <div class="addChild">

                <h4 style="padding-top: 50px; border-top: 1px solid #ddd; margin-top: 50px;">
                    <?php echo Rights::t('core', 'Add Banner'); ?>
                </h4>

                <?php if ($bannerModel !== null) { ?>

                    <?php
                    if ($model->type == BannerType::TYPE_ADSENSE) {
                        $this->renderPartial('/banner/_form_adsense', array(
                            'model' => $bannerModel,
                        ));
                    } else {
                        $this->renderPartial('/banner/_form', array(
                            'model' => $bannerModel,
                            'photos' => $photos,
                        ));
                    }
                    ?>
                <?php } ?>

            </div>
        </div>
    </div>

<?php } ?>