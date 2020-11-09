<?php

/**
 * Created by PhpStorm.
 * User: batyr
 * Date: 10/24/2017
 * Time: 12:47 PM
 */
class PageHelper
{
    static public function pageString($param = 'page')
    {
        $page = (int)Yii::app()->request->getQuery($param, 1);
        return $page > 1 ? ' - '.Yii::t('app','Page').' ' . $page : '';
    }
}