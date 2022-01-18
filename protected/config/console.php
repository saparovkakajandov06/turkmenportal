<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'My Console Application',
    'import' => array(
        'application.vendor.*',
        'application.models.*',
        'application.components.*',
    ),
    // application components
    'components' => array(
        'db' => require('db.php'),
        'cache' => array(
            'class' => 'system.caching.CFileCache',
            'keyPrefix' => 'test',
        ),
    ),

//    'commandMap' => array (
//        'cron' => 'ext.PHPDocCrontab.PHPDocCrontab'
//    ),
);