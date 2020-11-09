
<div class="mobile_block row" >
    
    <?php
    
    foreach ($compositionsModels as $data){ 
        $this->render('/tiles/_tilesview', array('data'=>$data,'item_class'=>$item_class));
    }
    ?>
   
</div>

