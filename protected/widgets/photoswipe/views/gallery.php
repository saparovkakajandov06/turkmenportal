<div id="photoswipe-gallery" class="my-gallery">

<?php 
    
    if(isset($this->photos)){
        $main_image=array();
        $other_images=array();
        foreach ($this->photos as $key=>$data) {
            if(!isset($data['caption']) && strlen($data['caption'])==0 )
                $data['caption']=$data['title'];
            
            if(isset($data['is_main']) && $data['is_main']==1){
                $main_image=$data;
            }else{
                $other_images[]=$data;
            }
        }


        if(count($main_image)==0){
            $main_image=  array_splice($other_images, 1);
        }
    
    
        ?>
        
        <a href="<?php echo $main_image["src"]; ?>" 
           data-size="<?php echo $main_image["width"]."x".$main_image["height"]; ?>"  
            data-author="<?php echo $main_image["author"]; ?>"  
           <?php if(isset($main_image["med"])){ ?> 
                data-med="<?php echo $main_image["med"]["src"]; ?>" 
                data-med-size="<?php echo $main_image["med"]["width"]."x".$main_image["med"]["height"]; ?>"  
           <?php } ?>
        class="gallery_main"
        >
            <img src="<?php echo $main_image["thumb"]; ?>" alt="<?php echo $main_image["alt"]; ?>" />
            <?php if($main_image['caption']){ ?>
                <figure><?php echo $main_image["caption"]; ?></figure>
            <?php } ?>
            <span class="image_zoom"><i class="fa fa-search"></i></span>

        </a>
    
    
        <?php foreach ($other_images as $data) { ?>
            <a href="<?php echo $data["src"]; ?>" 
               data-size="<?php echo $data["width"]."x".$data["height"]; ?>"  
                data-author="<?php echo $data["author"]; ?>"  
               <?php if(isset($data["med"])){ ?> 
                    data-med="<?php echo $data["med"]["src"]; ?>" 
                    data-med-size="<?php echo $data["med"]["width"]."x".$data["med"]["height"]; ?>"  
               <?php } ?>
            >
                
                <img src="<?php echo $data["thumb"]; ?>" alt="<?php echo $data["alt"]; ?>" title="<?php echo $data["title"]; ?>" />

                <?php if($data['caption']){ ?>
                    <figure><?php echo $data["caption"]; ?></figure>
                <?php } ?>

            </a>

        <?php } 
    }?>

</div>