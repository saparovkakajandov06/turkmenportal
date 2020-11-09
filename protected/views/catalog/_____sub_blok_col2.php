<?php
$catalogs = $modelCatalog->searchForCategory($subcatModel->id, 6, true);

if (isset($catalogs) && is_array($catalogs) && count($catalogs) > 0) {
?>
    <div class="box_header">
        <div class="header">
            <?php echo CHtml::link($subcatModel->getMixedDescriptionModel()->name, Yii::app()->createUrl('//catalog/category/',array('category_id'=>$subcatModel->id)), array('class' => "headerColor")); ?>
        </div>
    </div>

    <div class="box_content">
        <div class="row">
            <div class="col-sm-12">
                <?php foreach ($catalogs as $key => $catalog) { ?>
                        <?php $this->renderPartial('_listview_as_blocks', array('data' => $catalog)); ?>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>