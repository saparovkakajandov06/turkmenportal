<?php
/**
 * Created by PhpStorm.
 * User: ecmngnt
 * Date: 3/12/21
 * Time: 9:42 PM
 */

class LoggingRecord extends CActiveRecordBehavior
{

    public $client_id, $worker_id;

    public function afterSave($event)
    {

//        $criteria = new CDbCriteria;
//        $criteria->compare('model', get_class($this->owner), true);
//        $criteria->compare('model_id', $this->owner->id);
//        if (isset($this->client_id) && $this->client_id !== '') {
//            $client_log = ClientsLog::model()->find($criteria);
//            if (!isset($client_log)) {
//                $client_log = new ClientsLog();
//            }
//
//            $client_log->client_id = $this->client_id;
//            $client_log->model = get_class($this->owner);
//            $client_log->model_id = $this->owner->id;
//            $client_log->date_created = date('Y-m-d H:i:s');
////                    var_dump($client_log->save());die;
//            $client_log->save();
//        } else {
//            ClientsLog::model()->deleteAll($criteria);
//        }

//        if (isset($this->worker_id) && $this->worker_id !== '') {
//            $worker_log = WorkersLog::model()->find($criteria);
//            if (!isset($worker_log)) {
//                $worker_log = new WorkersLog();
//            }
//
//            $worker_log->worker_id = $this->worker_id;
//            $worker_log->model = get_class($this->owner);
//            $worker_log->model_id = $this->owner->id;
//            $worker_log->date_created = date('Y-m-d H:i:s');
//            $worker_log->save();
//        } else {
//            WorkersLog::model()->deleteAll($criteria);
//        }

        parent::afterSave($event);
    }


    public function afterFind($event)
    {
//        $criteria = new CDbCriteria;
//        $criteria->compare('model', get_class($this->owner), true);
//        $criteria->compare('model_id', $this->owner->id);
//
//        $client_log = ClientsLog::model()->find($criteria);
//        if(isset($client_log)){
//            $this->owner->client_id = $client_log->client_id;
//        }
//
//        $worker_log = WorkersLog::model()->find($criteria);
//        if(isset($worker_log)){
//            $this->owner->worker_id = $worker_log->worker_id;
//        }

        parent::afterFind($event); // TODO: Change the autogenerated stub
    }


    public function setInfo($data)
    {
        $this->client_id = $data['client_id'];
        $this->worker_id = $data['worker_id'];
    }


}