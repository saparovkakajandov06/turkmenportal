<div class="inner-tab">
    <div class="col-xs-12">

         <?php echo '<?php'; echo "\n";?>
                 $tabs=array();
                 $actived=true;
                 foreach ($descriptions as $key => $descriptionModel) {
                        $languageModel=Language::model()->findByPk($descriptionModel->language_id);
                        if(isset ($descriptionModel)){
                            $tabs[]=array('id' => $key, 'label' => $languageModel->name, 'content' => $this->renderPartial('//<?php echo $this->class2id($this->modelClass); ?>Description/_form_tabbed', array('model'=>$descriptionModel,'form'=>$form), true, false), 'active'=>$actived);
                            if($actived==true)
                                $actived=false;
                        }
                 }


                $this->widget('bootstrap.widgets.TbTabs', array(
                    "id" => "<?php echo $this->class2id($this->modelClass); ?>-inner-form-tabs",
                    "type" => "tabs",
                    'tabs' => $tabs
                ));
        ?>
    </div>
</div>