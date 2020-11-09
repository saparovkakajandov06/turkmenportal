<div class="inner-tab">
    <div class="col-xs-12">

         <?php
                 $tabs=array();
                 $actived=true;
                 foreach ($descriptions as $key => $descriptionModel) {
                        $languageModel=Language::model()->findByPk($descriptionModel->language_id);
                        if(isset ($descriptionModel)){
                            $tabs[]=array('id' => $key, 'label' => $languageModel->name, 'content' => $this->renderPartial('//estatesDescription/_form_tabbed', array('model'=>$descriptionModel,'form'=>$form), true, false), 'active'=>$actived);
                            if($actived==true)
                                $actived=false;
                        }
                 }


                $this->widget('bootstrap.widgets.TbTabs', array(
                    "id" => "estates-inner-form-tabs",
                    "type" => "tabs",
                    'tabs' => $tabs
                ));
        ?>
    </div>
</div>