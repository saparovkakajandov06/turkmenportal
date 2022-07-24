<?php if(isset($this->breadcrumbs)){ ?>
<div class="row">
<div class="sub_categories">
<div class="col-md-12">
    <?php
        if ( Yii::app()->controller->route !== 'site/index' )
                $this->breadcrumbs = array_merge(array (Yii::t('app','Home')=>Yii::app()->homeUrl), $this->breadcrumbs);

            $this->widget('zii.widgets.CBreadcrumbs', array(
                'links'=>$this->breadcrumbs,
                'homeLink'=>false,
                'tagName'=>'ol',
                'separator'=>'',
                'activeLinkTemplate'=>'<li><a href="{url}">{label}</a> </li>',
                'inactiveLinkTemplate'=>'<!--noindex--><li><span>{label}</span></li><!--/noindex-->',
                'htmlOptions'=>array ('class'=>' breadcrumb')
            )); ?>
</div>
</div>
</div>
<?php } ?>
                                        