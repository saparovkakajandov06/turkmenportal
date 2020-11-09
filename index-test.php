<?php
//@ini_set('display_errors', 'on');

// change the following paths if necessary
$yii=dirname(__FILE__).'/yii/framework/yii.php';
$main_config=dirname(__FILE__).'/protected/config/main.php';
$local_config=dirname(__FILE__).'/protected/config/local-config-tp.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
//error_reporting(E_ALL ^ E_WARNING );

require_once($yii);
$local=require($local_config);
$base=require($main_config);
$config=CMap::mergeArray($base, $local);
Yii::createWebApplication($config)->run();
