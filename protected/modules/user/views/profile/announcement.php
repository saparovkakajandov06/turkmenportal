<?php $this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("announcement");
$this->breadcrumbs = array(
    UserModule::t("Profile") => array('profile'),
    UserModule::t("Edit"),
);

$this->menu = array(
//    ((UserModule::isAdmin())
//        ? array('label' => UserModule::t('Manage Users'), 'url' => array('/user/admin'))
//        : array()),
    array('label' => UserModule::t('Profile'), 'url' => array('/user/profile')),
    array('label' => UserModule::t('Edit'), 'url' => array('/user/profile/edit')),
    array('label' => UserModule::t('Change password'), 'url' => array('/user/profile/changepassword')),
    array('label' => UserModule::t('Logout'), 'url' => array('/user/logout')),
);
?>

<?php if (Yii::app()->user->hasFlash('profileMessage')): ?>
    <div class="success">
        <?php echo Yii::app()->user->getFlash('profileMessage'); ?>
    </div>
<?php endif; ?>

<div class="box_header_index">
    <div class="header">
        <h1 class="headerColor"><?php echo Yii::t('app', 'announcement'); ?></h1>
    </div>
</div>

<?php
$this->widget('bootstrap.widgets.BootGridView', array(
    'id' => 'announcement-grid',
    'type' => 'striped  condensed',
    'dataProvider' => $dataProvider,
    'htmlOptions' => array('class' => 'table-tp'),
    'summaryText' => false,
    'pagerCssClass' => "pagination",
    'pager' => array('header' => '',
//                    'maxButtonCount' => $this->maxButtonCount,
        'cssFile' => false,
        'htmlOptions' => array('class' => 'pagination pull-right'),
        'prevPageLabel' => '<i class="fa fa-chevron-left"></i>',
        'nextPageLabel' => '<i class="fa fa-chevron-right"></i>',
        'firstPageLabel' => Yii::t('app', '$LNG_FIRST'),
        'lastPageLabel' => Yii::t('app', '$LNG_LAST'),
    ),
    'columns' => array(
        array(
            'name' => 'thumb',
            'value' => '$data["thumb"]',
            'type' => 'image',
        ),
        array(
            'name' => 'title',
            'value' => 'CHtml::encode($data["material_title"])',
            'type' => 'raw',
        ),
        array(
            'name' => 'description',
            'value' => 'CHtml::encode($data[material_description])',
            'type' => 'raw',
        ),
        array(
            'name' => 'category',
            'headerHtmlOptions' => array('style' => 'width: 170px; text-align:center;'),
            'value' => 'CHtml::encode($data["category_name"])',
            'type' => 'raw',
        ),
        array(
            'name' => 'date_added',
            'value' => '$data["date_added"]',
            'type' => 'datetime',
            'htmlOptions' => array('style' => 'width: 120px; text-align:right;'),

        ),

        array(
            'class' => 'bootstrap.widgets.BootButtonColumn',
            'htmlOptions' => array('style' => 'width: 85px; text-align:right;', 'class' => 'button_grid button-column'),
            'template' => '{view}{update}{delete}',
            'buttons' => array(
                'view' => array(
                    'url' => '$data["material"]->url',

                ),
                'update' => array(
                    'url' => '$data["material"]->urlupdate',

                ),
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("item/delete",array("id"=>$data["material_id"],"class"=>$data["material_class"]))',

                ),
            ),
        ),
    ),
));
?>


<?php

    Yii::app()->clientscript
    ->registerCssFile(Yii::app()->theme->baseUrl . '/css/sweetalert2/sweetalert2.min.css')
    ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/sweetalert2/sweetalert2.min.js', CClientScript::POS_END)
    ->registerScript(1,"
       var alertMsg = '$alertMsg';
        
       $(document).ready(function(){
          if (alertMsg.length > 10){
            
            swal({
                 title: \"\",
                text: alertMsg,
                type: 'success',
                showCloseButton: false,
                showConfirmButton: false,
                timer: 5000
                //confirmButtonText: 'OK'
            });
            setTimeout(function(){ 
                var url = removeParam('status');
                location.href = url;
             
             }, 5000);
          }                                                                      
       });
     
   
      function removeParam(parameter)
        {
          var url=document.location.href;
          var urlparts= url.split('?');
        
         if (urlparts.length>=2)
         {
          var urlBase=urlparts.shift(); 
          var queryString=urlparts.join(\"?\"); 
        
          var prefix = encodeURIComponent(parameter)+'=';
          var pars = queryString.split(/[&;]/g);
          for (var i= pars.length; i-->0;)               
              if (pars[i].lastIndexOf(prefix, 0)!==-1)   
                  pars.splice(i, 1);
          url = urlBase+'?'+pars.join('&');
          window.history.pushState('',document.title,url); // added this line to push the new url directly to url bar .
        
        }
        return url;
        }
    
  
    ",CClientScript::POS_END);



?>