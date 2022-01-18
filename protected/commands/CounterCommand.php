<?php

class CounterCommand extends CConsoleCommand
{
    public function actionIndex()
    {
        $data = Yii::app()->cache->get('counter_list');

        $transaction = Yii::app()->db->beginTransaction();
        foreach ($data as $key => $item){
            Yii::app()->db->createCommand()
                ->update($item['table_name'],
                    [
                        $item['field_name'] => new CDbExpression(':count', [':count' => $item['count']])
                    ],
                    'id=:id',
                    [
                        ':id' => $key,
                    ]
                );
        }
        if ($transaction->active){
            $transaction->commit();
            Yii::app()->cache->delete('counter_list');
        }
    }
}