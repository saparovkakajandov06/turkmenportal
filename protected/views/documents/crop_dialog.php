

<?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'crop_dialog',
        'options' => array(
            'title' => Yii::t('app','$LNG_TOVAR_ADD'),
            'modal'=>true,
            'resizable'=>false,
            'autoOpen'=>true,
            'stack'=>false, 
            'width'=>'1000',
            'height'=>'800',
        ),
    ));
    
    echo $this->renderPartial('//documents/crop', array('model' => $model));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
?>