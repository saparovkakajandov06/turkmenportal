<?php

class DPingBehavior extends CActiveRecordBehavior
{
    public $urlAttribute = 'url';
    public $pingByCreate = true;
    public $pingByUpdate = false;
//    public $pingByUpdate = true;
 
    public function afterSave($event)
    {
        $model = $this->getOwner();
        if ($this->pingByCreate && $model->isNewRecord || $this->pingByUpdate) {
            Yii::app()->rpcManager->pingPage($model->{$this->urlAttribute});
        }
    }
}

?>