<div class="searchForm row">
    <?php echo CHtml::beginForm(Yii::app()->createUrl('//search/search'),'get'); ?>
    <div class="col-md-2 col-padding-reset">
        <?php
            echo CHtml::dropDownList('category_id', '', Category::model()->getCategoryTreeList(), array('prompt' => Yii::t('app','categories'),'options' => array($category_id=>array('selected'=>true)),
                'class' => "category_id",
            ));
        ?>
    </div>
    <div class="col-md-2 col-padding-reset">
    <?php
            echo CHtml::dropDownList('region_id', '', Regions::model()->getListByParentCode('tm'), array('prompt' => Yii::t('app', "regions"),'options' => array($region_id=>array('selected'=>true)),
                'class' => "region_id",
            ));
    ?>
    </div>
    <div class="col-md-8 col-padding-reset">
        <?php echo CHtml::textField('query',$query) ?>
        <?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
    </div>
    <?php echo CHtml::endForm(); ?>
</div>