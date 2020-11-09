<?php //if(isset($data->material)){ 
//echo "<pre>";
//print_r($data->attributes);
//echo "</pre>";
?>
    <h4><?php //echo CHtml::link(CHtml::encode($data->title), $data->material->url); ?></h4>
    <p><?php //echo $this->getFragment(strip_tags($data['text']), $query); ?></p>
<?php //}?>

<div class="row">
    <div class="col-xs-4 col-md-4">
        <span class="subcategory">
            <?php echo CHtml::link($data->material->getMixedProfessionName(), Yii::app()->createUrl("//work/index", array('profession_id' => $data->profession_id)), array('rel' => 'bookmark')); ?>
        </span>
    </div>
    <div class="col-xs-8 col-md-8">
        <span class="mini_description">
            <?php
            $title = $data->material->getMixedDescriptionModel()->experience;
            echo CHtml::link($this->truncate($title, 6, 200), $data->material->url, array('alt' => $title,'title' => $title, 'rel' => 'bookmark'));
            ?>
        </span>
    </div>
</div>