<?php if (isset($related_relation) && isset($related_relation_id)) { 
    
    $commentsModel=new Comments();
    $commentsModel->default_scope=array('enabled', 'sort_oldest');
    $commentsModel->unsetAttributes();
    $commentsModel->related_relation=$related_relation;
    $commentsModel->related_relation_id=$related_relation_id;
        
?>
    <div id="comments_form">
        <?php if(Yii::app()->user->isGuest){ ?>
            <div class="fake_comment_input"> 
                <?php
                        UserModule::sendMail($model->email, UserModule::t("You registered from {site_name}", array('{site_name}' => Yii::app()->name)), UserModule::t("Please activate you account go to {activation_url}", array('{activation_url}' => $activation_url)));
                ?>
                <?php 
                
                echo Yii::t('app', 'login_for_comment {{login_url}} or {{register_url}}', array('{{login_url}}' => CHtml::link(Yii::t('app', 'comment_login'),Yii::app()->createUrl('//user/login')), '{{register_url}}' => CHtml::link(Yii::t('app', 'comment_register'),Yii::app()->createUrl('//user/registration')) )); ?>
            </div>
            <?php } else {?>
            <?php $this->renderPartial('//comments/_form',array('model' => $commentsModel)); ?>
        <?php } ?>
    </div>


    <div id="comments" >
        <?php
            $this->widget('bootstrap.widgets.BootListView', array(
                'id' => 'comments_listview',
                'summaryText' => '',
                'dataProvider' => $commentsModel->searchForRender(),
                'itemView' => '//comments/_view',
                'pagerCssClass'=>"pagination",
                'pager' => array('header' => '',
                             'maxButtonCount' => $this->maxButtonCount,
                             'cssFile' => false,
                             'htmlOptions'=>array('class'=>'pagination pull-right'),
                             'prevPageLabel' => '<i class="fa fa-chevron-left"></i>',
                             'nextPageLabel' => '<i class="fa fa-chevron-right"></i>',
                             'firstPageLabel' => Yii::t('app','$LNG_FIRST'),
                             'lastPageLabel' => Yii::t('app','$LNG_LAST'),
                ),
//                'emptyText'=>Yii::t('app','not_yet_commented'),
                'emptyText'=>'',
            ));
        ?>
    </div>
<?php } ?>