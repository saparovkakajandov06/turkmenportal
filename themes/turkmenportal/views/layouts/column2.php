<?php /* @var $this Controller */ ?>
<?php $themeUrl = Yii::app()->theme->baseUrl; ?>
<?php $this->beginContent('//layouts/column2_wrapper'); ?>

<?php if ($this->is_inner_breadcrumb == false)
    $this->renderPartial('//layouts/frontend/tpl_breadcrumbs')
?>

<div class="row mobile_block inned">
    <?php if ($this->is_inner_breadcrumb == true)
        $this->renderPartial('//blog/_sub_categories', array('modelCategory' => $this->subCategoryModel)); ?>

    <div class="col-md-8 bg-base col-lg-9 col-xl-9">
        <?php echo $content; ?>
    </div>

    <div class="sidebar col-md-4 col-lg-3 col-xl-3" style="width: 23%; float: right;">
        <?php require_once('frontend/tpl_col2r_sidebar.php') ?>
    </div>
</div>

<?php $this->endContent(); ?>

                
                