<div class="row mobile_block">
    <div class="col-md-9 bg-base col-lg-9 col-xl-9" >
        <?php
            $this->render('_main_block', array('mainBlogModel'=>$mainBlogModel,'newestBlogModels'=>$newestBlogModels, 'popularBlogModels'=>$popularBlogModels));
        ?>
    </div>

     <div class="sidebar col-md-3 col-lg-3 col-xl-3 pull-right">
        <?php
            $this->widget('BannersWidget', array(
                    'type' => 'bannerA',
                    'outer_css_class' => 'colheight-sm-2 hidden-xs',
                    'outer_css_id' => 'banner2',
                ));
        ?>
    </div>
</div>


<div class="row mobile_block" style="margin-top: 20px;">
    
    <?php foreach ($bottomBlogModels as $blog){ 
        $this->render('_bottom_list_view', array('data'=>$blog));
    }?>
   
</div>

