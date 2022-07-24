<nav id="header" class="header-navbar">
    <div class="header-navbar-inner container">
        <div class="row">
            <div class="col-xs-5 col-md-8">
                <ul class="nav navbar-nav ">
                    <li class=" pull-left home_icon">
                        <a href="<?php  echo Yii::app()->createUrl('//site/index'); ?>" data-toggle="li"> 
                            <span class="text"><span class="fa fa-home fa-lg"></span> </span>
                        </a>
                    </li>
                    <?php
                        $top_categories = Category::model()->enabled()->is_top()->findAll();
                        $a = array_shift($top_categories);
                        array_push($top_categories, $a);
                        $categories = Category::model()->enabled()->not_topmenu()->findAll();
                        $contoller = Yii::app()->controller->id;
                    ?>
                    
                    <li class="nav-all pull-left full-subnav-wrapper">
                        <a href="#" data-toggle="li"> 
                            <span class="text"><span class="fa fa-align-justify"></span> <?php echo Yii::t('app','All categories'); ?></span>
                            <span class="toggle fa fa-align-justify"></span>
                        </a>
                        <div class="row subnav-wrapper">
                            <div class="col-md-12 col-xs-12 subnav_inner sub_category">
                                <div class="mobile_top_categories visible-xs">
                                <?php
                                    foreach ($top_categories as $category) {
                                        echo '<div class="col-md-6 col-sm-6 bg-bar"> ';
                                        echo CHtml::link($category->name, $category->url,array("class" => "subnav-header"));
                                        echo '</div>';
                                    }
                                ?>
                                </div>
                                
                                <?php
                                    foreach ($categories as $category) {
                                        echo '<div class="col-md-6 col-sm-6 bg-bar">';
                                        echo CHtml::link($category->name, $category->url, array("class" => "subnav-header"));
                                        echo '</div>';
                                    }
                                ?>
                            </div>
                            <div class="mobile-nav-all ">
                                <a href="#" data-toggle="li">
                                    <span class="toggle fa fa-remove"></span>
                                </a>

                            </div>
                        </div>
                    </li>
                    

                    <?php
                    foreach ($top_categories as $category) {
                        $class=($contoller==$category->url_prefix ? "active" :"");
                        if($class=='active'){
                            if(isset($this->subCategoryModel)){
                                if($this->subCategoryModel->alias_ru!=$category->alias_ru){
                                    $class="";
                                }
                            }
                        }
                        echo '<li class="'.$class.'"> ';
                        echo CHtml::link($category->name, $category->getUrl());
                        echo "</li>";
                    }
                    ?>
                </ul>
            </div>
            <div class="col-xs-7 col-md-4">
                <ul class="nav navbar-nav config-panel" style="float: right;">
                    <li class="nav-all">
                        <a href="<?php echo Yii::app()->createUrl('//item/index'); ?>" class="obyawa_button">
                            <span class="text obyawa_button"><span class="fa fa-plus-circle"></span><?php echo Yii::t('app', 'Add obyawa'); ?></span>
                            <span class="toggle fa fa-plus-circle"></span>
                        </a>
                    </li>
                    <li style="position: static;" class="nav-all">
                        <a href="#" class="ajaxSearch"> 
                            <span class="text"><span class="fa fa-search"></span><?php echo Yii::t('app', 'Search'); ?></span>
                            <span class="toggle fa fa-search"></span>
                        </a>
                    </li>
                        <?php $this->renderDynamic('dynamicUsername'); ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="nav-popup container">
        <?php echo CHtml::link('<span class="fa fa-remove"></span>', '#',array('class'  => 'close_panel')); ?>
        <div class="container">
            <div id="nav-popup-inner">
            </div>
        </div>
    </div>
    
        <div class="background_glow"></div>

        <div class="container">
            <div class="row">
                <div class="searchPanel">
                    <div class="row">
                        <?php echo CHtml::beginForm(Yii::app()->createUrl('//search/search'),'get'); ?>
                        <div class="col-md-12">
                            <div class="search_wrapper">
                                <?php echo CHtml::textField('query','',array('placeholder'=>Yii::t('app','tp_search_placeholder'))); ?>
                            </div>
                            <?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
                        </div>
                        <?php echo CHtml::endForm(); ?>
                    </div>

                </div>
            </div>
        </div>
</nav>