<?php
$title=$model->getMixedDescriptionModel()->title;
$this->breadcrumbs = array(
    $title
    //    Yii::t('app', 'Informations') => array('index'),
//    Yii::t('app', $model->getMixedDescriptionModel()->title),
);
?>

<div class="row">

<div class="col-md-12">
    <h1 class="blog_header"> <?=$title ?></h1>
</div>
    
<div class="col-md-12">

<div class="article_text" itemprop="articleBody">
    <?php echo $model->getMixedDescriptionModel()->description; ?>
</div>
</div>
</div>

