<div class="inner-tab">
    <div class="col-xs-12">

         <?php
                $tabs=array();
                $actived=true;
                $languages=  Language::model()->findAllByAttributes(array('status'=>1));
                foreach ($languages as $language) {
                    $tabs[]=array('id' => $key, 'label' => $language->name, 'content' => $this->renderPartial('_form_description', array('model'=>$model,'language'=>$language,'form'=>$form), true, false), 'active'=>$actived);
                    if($actived==true)
                        $actived=false;
                }


                $this->widget('bootstrap.widgets.TbTabs', array(
                    "id" => "catalog-inner-form-tabs",
                    "type" => "tabs",
                    'tabs' => $tabs
                ));
        ?>
    </div>
</div>