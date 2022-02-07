<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array (
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'My Console Application',
    'import' => array (
        'application.vendor.*',
        'application.components.*',
        'application.models.*',
        'application.extensions.taggable.*',
        'application.modules.user.UserModule',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
    ),
    // application components
    'components' => array (
        'db' => require('db.php'),
    ),
//    'commandMap' => array (
//        'cron' => 'ext.PHPDocCrontab.PHPDocCrontab'
//    ),
);