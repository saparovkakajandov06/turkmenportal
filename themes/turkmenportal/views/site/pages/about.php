	<div class="page-header">
	    <h1><?php echo Yii::t('app','$LNG_ABOUT_US'); ?><!--<small>&nbsp;<?php echo Yii::t('app','$LNG_WHAT_WE_ARE_ABOUT'); ?></small>--></h1>
	</div>
	<div class="row-fluid">
     <div class="span9">
     	<h3 class="header"><?php echo Yii::t('app','$LNG_OUR_TEAM'); ?><span class="header-line"></span></h3>
    	<div class="row-fluid">        
        	<div class="span4">
	            <div class="colored_banner thumb-content-dark">
		            <!--<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/simpson2.jpg" width="260" height="180" alt="Me" />-->
		            <h4 style="border-bottom: 1px solid #AAA; padding-bottom: 5px;"><?php echo Yii::t('app','$LNG_OUR_TEAM_SHORT1'); ?> <small><?php echo Yii::t('app','$LNG_OUR_TEAM_WORK1'); ?></small></h4>
		            <p><?php echo Yii::t('app','$LNG_OUR_TEAM_LONG1'); ?></p>
		            <!--<div><img src="<?php echo Yii::app()->theme->baseUrl;?>/img/icons/social/facebook.png"  alt="Facebook" /> <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/icons/social/twitter.png"  alt="Twitter" /> <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/icons/social/linkedin.png"  alt="LinkedIn" /> <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/icons/social/google.png"  alt="Google+" /> <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/icons/social/email.png"  alt="RSS" /></div>-->
	            </div>
        	</div>
         
			<div class="span4">
				<div class="colored_banner thumb-content-dark">
					<!--<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/simpson4.jpg" width="260" height="180" />-->
					<h4 style="border-bottom: 1px solid #AAA; padding-bottom: 5px;"><?php echo Yii::t('app','$LNG_OUR_TEAM_SHORT2'); ?> <small><?php echo Yii::t('app','$LNG_OUR_TEAM_WORK2'); ?></small></h4>
					<p><?php echo Yii::t('app','$LNG_OUR_TEAM_LONG2'); ?></p>
				<!--<div><img src="<?php echo Yii::app()->theme->baseUrl;?>/img/icons/social/facebook.png"  alt="Facebook" /> <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/icons/social/twitter.png"  alt="Twitter" /> <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/icons/social/linkedin.png"  alt="LinkedIn" /> <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/icons/social/google.png"  alt="Google+" /> <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/icons/social/email.png"  alt="RSS" /></div>-->
			</div>
		</div>
          
			<div class="span4">
				<div class="colored_banner thumb-content-dark">
					<!--<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/simpson5.jpg" width="260" height="180" />-->
					<h4 style="border-bottom: 1px solid #AAA; padding-bottom: 5px;"><?php echo Yii::t('app','$LNG_OUR_TEAM_SHORT3'); ?> <small><?php echo Yii::t('app','$LNG_OUR_TEAM_WORK3'); ?></small></h4>
					<p><?php echo Yii::t('app','$LNG_OUR_TEAM_LONG3'); ?></p>
					<!--<div><img src="<?php echo Yii::app()->theme->baseUrl;?>/img/icons/social/facebook.png"  alt="Facebook" /> <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/icons/social/twitter.png"  alt="Twitter" /> <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/icons/social/linkedin.png"  alt="LinkedIn" /> <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/icons/social/google.png"  alt="Google+" /> <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/icons/social/email.png"  alt="RSS" /></div>-->
					</div>
				</div>
      		</div>
   		</div>
     
     <div class="span3">
    
      <h3 class="header"><?php echo Yii::t('app','$LNG_WE_ARE_HIRING_SHORT'); ?><span class="header-line"></span></h3>
      <div class="well">
      <p><?php echo Yii::t('app','$LNG_WE_ARE_HIRING_LONG'); ?></p>
      <ul class="list-icon">
        <li><?php echo Yii::t('app','$LNG_VACANSY1'); ?></li>
        <li><?php echo Yii::t('app','$LNG_VACANSY2'); ?></li>
        <li><?php echo Yii::t('app','$LNG_VACANSY3'); ?></li>
      </ul>
      <p>
          <?php echo CHtml::link(Yii::t('app','$LNG_JOIN_OUR_TEAM'),array('contact/create'),array('class'=>"btn btn-large btn-success")); ?>
      </p>
     </div>
     </div>
    
  </div> <!--/row-fluid -->
  
  <hr />

    <div class="row-fluid">
        <ul class="thumbnails">
          <li class="span4">
            <div class="thumbnail">
            	<h3><?php echo Yii::t('app','$LNG_OUR_MISSION_SHORT'); ?></h3>
              	<p><?php echo Yii::t('app','$LNG_OUR_MISSION_LONG'); ?></p>
            </div>
          </li>
          <li class="span4">
            <div class="thumbnail">
                 <h3><?php echo Yii::t('app','$LNG_OUR_PHILOSOPHY_SHORT'); ?></h3>
              	<p><?php echo Yii::t('app','$LNG_OUR_PHILOSOPHY_LONG'); ?></p>
            </div>
          </li>
          <li class="span4">
            <div class="thumbnail">
               <h3><?php echo Yii::t('app','$LNG_VALUES_SHORT'); ?></h3>
              	<p><?php echo Yii::t('app','$LNG_VALUES_LONG'); ?></p>
            </div>
          </li>

        </ul>
    </div>
    
    <h3 class="header"><?php echo Yii::t('app','$LNG_OUR_SERVICES'); ?><span class="header-line"></span></h3>
      
	<div class="row-fluid">
    	<div class="span6">
            <div class="square-background clearfix">
               	<div class="square square-back pull-left">
                   <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/icons/fatcow/developing-site.png" alt="" class="">
          		</div>
                <h4><?php echo Yii::t('app','$LNG_OUR_SERVICES_SHORT1'); ?></h4>
                <p><?php echo Yii::t('app','$LNG_OUR_SERVICES_LONG1'); ?></p>
            </div>
        </div>
        <div class="span6">
        	<div class="square-background clearfix">
                <div class="square square-back  pull-left">
                    <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/icons/fatcow/developing-eshop.png" alt="" class="">
      			</div>
                <h4><?php echo Yii::t('app','$LNG_OUR_SERVICES_SHORT2'); ?></h4>
         		<p><?php echo Yii::t('app','$LNG_OUR_SERVICES_LONG2'); ?></p>
            </div>
        </div>
    </div>
    <div class="row-fluid">	         
    	<div class="span6">
    		<div class="square-background clearfix">
                <div class="square square-back pull-left">
                    <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/icons/fatcow/developing-webapp.png" alt="" class="">
      			</div>
                <h4><?php echo Yii::t('app','$LNG_OUR_SERVICES_SHORT3'); ?></h4>
             	<p><?php echo Yii::t('app','$LNG_OUR_SERVICES_LONG3'); ?></p>
            </div> 
        </div>
        <div class="span6">
    		<div class="square-background clearfix">
                <div class="square square-back pull-left">
                    <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/icons/fatcow/consultation.png" alt="" class="">
      			</div>
                <h4><?php echo Yii::t('app','$LNG_OUR_SERVICES_SHORT4'); ?></h4>
             	<p><?php echo Yii::t('app','$LNG_OUR_SERVICES_LONG4'); ?></p>
            </div> 
        </div>
    </div> <!--/row-fluid-->
        
        <hr />
    
    <!--<div class="row-fluid">
        <div class="span9">
            <blockquote>
              <h2>This is by far the best theme i have purchased on Themeforest. It was so easy to install and customize. I will definately be buying from you again.</h2>
              <small>Someone famous guy<cite title="Source Title"> - Harvard Business Review</cite></small>
            </blockquote>
        </div>
        
        <div class="span3" style="text-align:center;">
        
        <h3 class="text-error">What are you waiting for?</h3>
        
        <button class="btn btn-large btn-danger" type="button">DOWNLOAD IT NOW!</button>
        <p> <small>* terms and conditions apply</small></p>
        
        </div>
        
    </div>-->
  
  <!--<h3 class="header">Our customers
    <span class="header-line"></span>  
  </h3>
  <div class="row-fluid">
    <div class="span3 center">
        <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/customers/themeforest.png" alt="Themeforest" />
    </div>
    <div class="span3">
        <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/customers/codecanyon.png" alt="Codecanyon" />
    </div>
    <div class="span3">
        <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/customers/graphicriver.png" alt="Graphicriver" />
    </div>
    <div class="span3">
        <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/customers/photodune.png" alt="Photodune" />
    </div>-->
      
 </div><!--/row-fluid-->
