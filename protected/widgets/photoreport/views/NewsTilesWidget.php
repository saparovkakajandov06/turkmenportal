
<div class="mobile_block row" >
    
    <?php
    foreach ($bottomBlogModels as $blog){ 
        $this->render('_tilesview', array('data'=>$blog));
    }
    ?>
   
</div>

