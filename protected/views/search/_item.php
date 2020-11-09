<?php //if(isset($data->material)){ ?>
    <h4 class="search_title"><?php echo CHtml::link(CHtml::encode($data->title), $data->material->url); ?></h4>
    <p class="search_content"><?php echo $this->getFragment(strip_tags($data['text']), $query); ?></p>
<?php //}?>