<?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'auto_dialog',
        'options' => array(
            'title' => Yii::t('app','$LNG_ADD'),
            'modal'=>true,
//            'resizable'=>false,
            'autoOpen'=>true,
            'stack'=>false, 
            'width'=>'1000',
            'height'=>'480',
        ),
    ));
    
    echo $this->renderPartial('//auto/_form', array('model' => $model));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
?>
