
<?php
    if(isset ($related_relation) && isset ($related_relation_id)){
        
//        $contactModel=new Contact();
//        $tabs = array();
//        $tabs[] = array('id' => 'comments_tab', 'label' => Yii::t('app', 'Comments'), 'content' => $this->renderPartial('//comments/listview',  array('related_relation' => $related_relation, 'related_relation_id' => $related_relation_id), true, false), 'active' => true);
//        $tabs[] = array('id' => 'ttttt', 'label' => Yii::t('app', 'contact_us'), 'content' => $this->renderPartial('//contact/_form_ajax', array('model' => $contactModel), true, false));
    //    $tabs[] = array('id' => 'image_tab', 'label' => Yii::t('app', 'Images'), 'content' => $this->renderPartial('_image_tabbed', array('photos' => $photos), true, false),);

        ?>
        <div class="comments__head"><?php echo Yii::t('app','comments'); ?></div> 
        
        <?php
        echo $this->renderPartial('//comments/listview',  array('related_relation' => $related_relation, 'related_relation_id' => $related_relation_id), false, false);
//        $this->widget('bootstrap.widgets.TbTabs', array(
//            "id" => "comments-form-tabs",
//            "type" => "tabs",
//            'tabs' => $tabs
//        ));
    }
    
?>