<?php
if (isset($afishas) && is_array($afishas) && count($afishas) > 5) { ?>
    
        <div class="row">
            <?php foreach($afishas as $key=>$data ){ 
                if($key<1){
                ?>
                    <div class="col-sm-12 col-xs-12">
                        <?php $this->render('_afisha_view_vertical', array('data' => $data)); ?>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>

<?php } ?>
