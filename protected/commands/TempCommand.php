<?php

/**
 * Created by PhpStorm.
 * User: batyr
 * Date: 9/30/2019
 * Time: 10:05 PM
 */
class TempCommand extends CConsoleCommand
{
    public function actionWorker()
    {
        $workerLog = WorkersLog::model()->findAll();
        $workerList = $this->getListWorkers();

        foreach ($workerLog as $item){
            $blog = BlogTemp::model()->findByPk($item->model_id);
            if (isset($blog)){
                $blog->worker_id = $item->worker_id;
                $blog->save();
            }
        }
        echo "workers dyndy";
    }

    public function actionClient()
    {
        $clientLog = ClientsLog::model()->findAll();
        $clientList = $this->getClientsList();

        foreach ($clientLog as $item) {
            $blog = BlogTemp::model()->findByPk($item->model_id);
            if (isset($blog)){
                $blog->client_id = $item->client_id;
                $blog->save();
            }
        }
        echo "clients dyndy";
    }


    public function getClientsList()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('status = 1');
        $criteria->order = 'client_name asc';
        $data = Clients::model()->findAll($criteria);
        $data = CHtml::listData($data, 'id', 'client_name');
        return $data;
    }

    public function getListWorkers() {
        $criteria = new CDbCriteria();
        $criteria->addCondition('status = 1');
        $criteria->order = 'nickname asc';
        $data = Workers::model()->findAll($criteria);
        $data = CHtml::listData($data, 'id', 'nickname');
        return $data;
    }
}