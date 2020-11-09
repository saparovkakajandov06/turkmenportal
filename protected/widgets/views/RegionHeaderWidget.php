
<div class="row">
    <div class="box_header_index">
        <div class="header">
            <?php
            echo CHtml::link($categoryModel->getMixedDescriptionModel()->name, Yii::app()->createUrl($this->categoy_index_url, array('category_id' => $categoryModel->id)), array('class' => "headerColor"));
            foreach ($sub_regions as $key => $region) {
                if ($key > $this->maxSubCatCount)
                    continue;
                echo CHtml::link($region->getMixedDescriptionModel()->region_name, Yii::app()->createUrl($this->categoy_index_url, array('category_id' => $categoryModel->id,'region_id' => $region->id)), array("class" => "indexLink blueColor"));
            }
            ?>
        </div>
    </div>
</div>

