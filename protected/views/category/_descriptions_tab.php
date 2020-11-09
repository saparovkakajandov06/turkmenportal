<div class="inner-tab">
    <div class="col-xs-12">

         <?php
//                 $tabs=array();
//                 $actived=true;
//                 foreach ($descriptions as $key => $descriptionModel) {
//                        $languageModel=Language::model()->findByPk($descriptionModel->language_id);
//                        if(isset ($descriptionModel)){
//                            $tabs[]=array('id' => $key, 'label' => $languageModel->name, 'content' => $this->renderPartial('_form_description', array('model'=>$model,'form'=>$form), true, false), 'active'=>$actived);
//                            if($actived==true)
//                                $actived=false;
//                        }
//                 }

                 
                $tabs=array();
                $actived=true;
                $languages=  Language::model()->findAllByAttributes(array('status'=>1));
                foreach ($languages as $language) {
                    $tabs[]=array('id' => $key, 'label' => $language->name, 'content' => $this->renderPartial('_form_description', array('model'=>$model,'language'=>$language,'form'=>$form), true, false), 'active'=>$actived);
                    if($actived==true)
                        $actived=false;
                }

              

                $this->widget('bootstrap.widgets.TbTabs', array(
                    "id" => "category-inner-form-tabs",
                    "type" => "tabs",
                    'tabs' => $tabs
                ));
        ?>
    </div>
</div>