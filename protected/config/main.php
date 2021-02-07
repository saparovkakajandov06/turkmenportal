<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

Yii::setPathOfAlias('bootstrap', dirname(__FILE__) . '/../extensions/bootstrap');
//Yii::setPathOfAlias('libphonenumber', Yii::getPathOfAlias('application.vendors.libphonenumber'));

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'onBeginRequest' => create_function('$event', 'return ob_start("ob_gzhandler");'),
    'onEndRequest' => create_function('$event', 'return ob_end_flush();'),
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'turkmenportal.com',
    'theme' => 'turkmenportal',
    // preloading 'log' component
    'preload' => array('log', php_sapi_name() !== 'cli' ? 'efontawesome' : '', php_sapi_name() !== 'cli' ? 'bootstrap-select' : '', php_sapi_name() !== 'cli' ? 'chartjs' : ''),
    'sourceLanguage' => '00',
    'language' => 'ru',

    // autoloading model and component classes
    'import' => array(
        'application.extensions.easyimage.EasyImage',
        'application.extensions.easyimage.*',
        'application.extensions.easyimage.drivers.Image',
        'application.models.*',
        'application.models.wrappers.*',
        'application.controllers.api*',
        'application.components.*',
        'application.components.json.*',
        'application.controllers.api*',
        'application.extensions.bootstrap.widgets.*',
        'application.extensions.activerecord-relation.*',
        'application.modules.user.UserModule',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
        'application.modules.rights.*',
        'application.modules.rights.components.*',
        'application.modules.page.models.*',
        'application.extensions.awegen.components.*',
        'application.extensions.xupload.*',
        'application.extensions.xupload.models.XUploadForm',
        'application.extensions.reCaptcha2.*',
//                'application.extensions.Image',
        'application.widgets.*',
        'application.widgets.news.*',
        'application.extensions.taggable.*',
        'ext.YiiMailer.YiiMailer',
        'ext.eoauth.*',
        'ext.eoauth.lib.*',
        'ext.lightopenid.*',
        'ext.eauth.*',
        'ext.WordFilter.*',
        'ext.eauth.services.*',
        'ext.spaces-api.SpacesConnect',
    ),
    'modules' => array(
        'backup' => array('path' => __DIR__ . '/../../_backup/'),
        'page',
        'rights' => array(
            'superuserName' => 'Admin', // Name of the role with super user privileges.
            'authenticatedName' => 'Authenticated',  // Name of the authenticated user role.
            'userIdColumn' => 'id', // Name of the user id column in the database.
            'userNameColumn' => 'username',  // Name of the user name column in the database.
            'enableBizRule' => true,  // Whether to enable authorization item business rules.
            'enableBizRuleData' => true,   // Whether to enable data for business rules.
            'displayDescription' => true,  // Whether to use item description instead of name.
            'flashSuccessKey' => 'RightsSuccess', // Key to use for setting success flash messages.
            'flashErrorKey' => 'RightsError', // Key to use for setting error flash messages.
            'baseUrl' => '/rights', // Base URL for Rights. Change if module is nested.
            'layout' => 'rights.views.layouts.main',  // Layout to use for displaying Rights.
            'appLayout' => '//layouts/column2_admin', // Application layout.
            'install' => false,  // Whether to enable installer.
            'debug' => false,
        ),


        'user' => array(
            'tableUsers' => 'tbl_users',
            'tableProfiles' => 'tbl_profiles',
            'tableProfileFields' => 'tbl_profiles_fields',
            'hash' => 'md5',
            'sendActivationMail' => true,
            # allow access for non-activated users
            'loginNotActiv' => false,
            # activate user on registration (only sendActivationMail = false)
            'activeAfterRegister' => false,
            # automatically login from registration
            'autoLogin' => true,
            # registration path
            'registrationUrl' => array('/user/registration'),
            # recovery password path
            'recoveryUrl' => array('/user/recovery'),
            # login form path
            'loginUrl' => array('/user/login'),
            # page after login
            'returnUrl' => array('/user/profile'),
            # page after logout
            'returnLogoutUrl' => array('/user/login'),
        ),

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'gii',
            'generatorPaths' => array(
                'ext.awegen',
            ),
        ),
    ),


    // application components
    'components' => array(
        'clientScript' => array(
            // disable default yii scripts
            'scriptMap' => array(
                'jquery.js' => false,
                'jquery.min.js' => false,
                'jquery.yii.js' => false,
                'jquery.ba-bbq.js' => false,
                'jquery.ba-bbq.min.js' => false,
                'jquery.yiilistview.js' => false,
                'jquery.yiiactiveform.js' => false,
                'jquery.bgiframe.js' => false,
                'jquery.autocomplete.js' => false,
                'jquery.ajaxqueue.js' => false,
                'jquery-ui.min.js' => false,
                'rights.js' => false,
                'jquery.history.js' => false,
                'jquery-ui-timepicker-addon.js' => false,

//                      'tmpl.min.js' => false,
//                      'jquery.fileupload.js' => false,
//                      'load-image.min.js' => false,
//                      'canvas-to-blob.min.js' => false,
//                      'jquery.iframe-transport.js' => false,
//                      'jquery.fileupload-ip.js' => false,
//                      'jquery.fileupload-ui.js' => false,

//                      'core.css'      => false,
//                      'styles.css'    => false,
//                      'pager.css'     => false,
//                      'default.css'   => false,
            ),
        ),

        'rpcManager' => array(
            'class' => 'DRPCManager',
            'pingEnable' => true,
            'pingServers' => array(
                'http://ping.blogs.yandex.ru/RPC2',
                'http://blogsearch.google.com/ping/RPC2'
            )
        ),

        'request' => array(
            'class' => 'DLanguageHttpRequest',
        ),
//            
        'urlManager' => array(
            'class' => 'DLanguageUrlManager',
            'urlFormat' => 'path',
            'showScriptName' => false,
//                    'useStrictParsing'=>false,
            'rules' => array(
//                        'http://user.turkmenportal.com' => 'user/profile',  
//                    	'http://user.turkmenportal.com/<controller:\w+>' => 'user/<controller>/',
//			'http://user.turkmenportal.com/<controller:\w+>/<action:\w+>' => 'user/<controller>/<action>',
//			'http://user.turkmenportal.com/<controller:\w+>/<action:\w+>/<id:\d+>' => 'user/<controller>/<action>',
//                        '<controller:\w+>/<profession_id:\d+>'=>'<controller>/index',
//                        '<controller:\w+>/generalCreate/<category_id:\d+>'=>'<controller>/generalCreate',
                '' => 'site/index',
                array('sitemap/index', 'pattern' => 'sitemap.xml', 'urlSuffix' => ''),
                'slmts' => 'backend/index',
                'rss' => 'rss/index',
//                'rss/yandex' => 'rss/yandex',
//                'rss/rambler' => 'rss/rambler',
                '<controller:rss>/<action:\w+>' => 'rss/<action>',
                '<controller:item>/<action:delete>/<class:\w+>/<id:\d+>' => 'item/delete',
                '<controller:item>/<code:\w+>/<id:\d+>' => '<controller>/index',
                '<controller:item>/<code:\w+>/cat/<category_id:\d+>' => '<controller>/index',
                'm/<module:\w+>/<controller:\w+>/<id:\d+>' => '<module>/<controller>/view',
                'm/<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
                'm/<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',

                'api/<controller:\w+>/<action:\w+>' => 'api/<controller>/<action>',

                '<controller:\w+>/<id:\d+>/<alias:[\w-]+>' => '<controller>/view',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/a/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/a/<action:\w+>' => '<controller>/<action>',
                '<controller:\w+>/category/<category_id:\d+>' => '<controller>/index',
                '<controller:\w+>/<path:[\w-\/]+>' => '<controller>/index',
            ),
        ),

        'user' => array(
            'class' => 'RWebUser',
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'loginUrl' => array('/user/login'),
        ),

        'authManager' => array(
            'class' => 'RDbAuthManager',
            'connectionID' => 'db',
            'defaultRoles' => array('Guest', 'ServiceAuth'),
            'itemTable' => 'authitem',
            'itemChildTable' => 'authitemchild',
            'assignmentTable' => 'authassignment',
            'rightsTable' => 'rights',
        ),

        'loid' => array(
            'class' => 'application.extensions.lightopenid.loid',
        ),

        'eauth' => array(
            'class' => 'ext.eauth.EAuth',
            // Использовать всплывающее окно вместо перенаправления.
            'popup' => true,
            // Имя компонента кэширования или false для отключения.
            // По умолчанию 'cache'.
            'cache' => false,
            // Время жизни кэша.
            'cacheExpire' => 0,
            // Провайдеры
            'services' => array(
                'yandex_oauth' => array(
                    //register your app here: https://oauth.yandex.ru/client/my
                    'class' => 'YandexOAuthService',
                    'client_id' => 'f83ce8d79ea84a56b418d33a90399136',
                    'client_secret' => 'd8731fca53c342cbacad2dc305170799',
                    'title' => 'Yandex (OAuth)',
                ),
                'google_oauth' => array(
                    //register your app here: https://code.google.com/apis/console/
                    'class' => 'GoogleOAuthService',
                    'client_id' => '481715557429-s8uu9i34jflj22r3oi3djutp1saru7ho.apps.googleusercontent.com',
                    'client_secret' => 'EX-Y4L-LaDZxtozDjzbeipIh',
                    'title' => 'Google (OAuth)',
                ),
                'vkontakte' => array(
                    //register your app here: https://vk.com/editapp?act=create&site=1
                    'class' => 'VKontakteOAuthService',
                    'client_id' => '6098386',
                    'client_secret' => '2K3PmuKXGihzryz2hhrX',
                ),
//                'mailru' => array(
//                    // register your app here: http://api.mail.ru/sites/my/add
//                    'class' => 'MailruOAuthService',
//                    'client_id' => '...',
//                    'client_secret' => '...',
//                ),
//                'odnoklassniki' => array(
//                    // register your app here: http://dev.odnoklassniki.ru/wiki/pages/viewpage.action?pageId=13992188
//                    // ... or here: http://www.odnoklassniki.ru/dk?st.cmd=appsInfoMyDevList&st._aid=Apps_Info_MyDev
//                    'class' => 'OdnoklassnikiOAuthService',
//                    'client_id' => '...',
//                    'client_public' => '...',
//                    'client_secret' => '...',
//                    'title' => 'Odnokl.',
//                ),
            ),
        ),

        'cache' => array(
            'class' => 'system.caching.CFileCache',
        ),

        'settings' => array(
            'class' => 'CmsSettings',
            'cacheComponentId' => 'cache',
            'cacheId' => 'turkmenportal_global_website_settings',
            'cacheTime' => 84000,
            'tableName' => 'tbl_settings',
            'dbComponentId' => 'db',
            'createTable' => false,
            'dbEngine' => 'InnoDB',
        ),

        'bootstrap' => array(
            'class' => 'bootstrap.components.Bootstrap',
            'coreCss' => false,
            'enableJS' => false,
            'yiiCss' => false,
            'responsiveCss' => false,
        ),
        'phpThumb' => array(
            'class' => 'ext.EPhpThumb.EPhpThumb',
        ),
        'efontawesome' => array(
            'class' => 'ext.EFontAwesome.components.EFontAwesome',
        ),

//                'assetManager' => array(
//                    'linkAssets' => true,
//                ),

        'mobileDetect' => array(
            'class' => 'ext.MobileDetect.MobileDetect'
        ),

        'easyImage' => array(
            'class' => 'application.extensions.easyimage.EasyImage',
            //'driver' => 'GD',
            //'quality' => 100,
            //'cachePath' => '/assets/easyimage/',
            //'cacheTime' => 2592000,
            //'retinaSupport' => false,
        ),

//		'urlManager'=>array(
//			'urlFormat'=>'path',
////                        'showScriptName'=>false,
//			'rules'=>array(
//				'admin'=>'site/admin',
//				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
////                                '<controller:\w+>/<action:\w+>/<service_type_id:\d+>'=>'<controller>/<action>',
//				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
//				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
//			),
//		),
        'db' => require(dirname(__FILE__) . '/db.php'),
//                'db'=>array(
//                    'connectionString' => 'mysql:host=127.0.0.1;dbname=websayt_turkmenportal',
//                    'emulatePrepare' => true,
//                    'username' => 'root',
//                    'password' => 'kebelek',
//                    'charset' => 'utf8',
//                    'enableProfiling'=>true,
//                    'enableParamLogging'=>true,
//                    'schemaCachingDuration' => 3600,
//                ),

//                'db'=>array(
//                    'connectionString' => 'mysql:host=localhost;dbname=turkmenp_tp2',
//                    'emulatePrepare' => true,
//                    'username' => 'turkmenp',
//                    'password' => 'K9Yc6osc26',
//                    'charset' => 'utf8',
//                    'enableProfiling'=>true,
//                    'enableParamLogging'=>true,
//                ),


        'errorHandler' => array(
            'errorAction' => 'site/error',
        ),

        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error,warning',
                    'logFile' => 'error_warning.log',
//                    'levels'=>'trace, info',
//                    'categories' => 'system.*',
                ),
                array(
                    'class' => 'CEmailLogRoute',
                    'levels' => 'error, warning',
                    'enabled' => true,
                    'categories' => 'system.*',
                    'emails' => array('ecmngnt@gmail.com'),
                ),
            ),
        ),


//            'log' => array(
//                'class' => 'CLogRouter',
//                'routes' => array(
//                    array(
//                        'class' => 'CFileLogRoute',
////                        'levels' => 'error, warning,trace, info',
//                        'levels' => 'error',
//                        'categories' => 'system.*',
//                    ),
//    //                            array(
//    //                                'class'=>'CProfileLogRoute',
//    //                                'report'=>'summary',
//    //                                // Показывает время выполнения каждого отмеченного блока кода.
//    //                                // Значение "report" также можно указать как "callstack".
//    //                            ),
//                ),
//            ),
        'WordFilter' => array(
            'class' => 'ext.WordFilter.WordFilter'
        )
    ),


    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'title' => 'Turkmenportal.com',
        'adminEmail' => 'no-reply@turkmenportal.com',
        'adminAlertEmail' => array('ars_encoder@mail.ru', 'tm-rubin@mail.ru', 'manager@turkmenportal.com', 'resuldovletmuradov@yandex.ru', 'gulnara281114@gmail.com'),
        'reCaptcha' => array(
//            'publicKey' => '6LcoSR4UAAAAACX5xpZha96sMqMEzwJBa7gOIku_',
            'publicKey' => '6Ldpl1EUAAAAAM-1y3CGee0GWnQKpDnAUOhr5_-S',
//            'privateKey' => '6LcoSR4UAAAAAFPo4kCC5ygeP_ULALQW10xe3Pbn',
            'privateKey' => '6Ldpl1EUAAAAAKG1Z3vQNLMXAtQYkqW9JlZmqqf0',
        ),
//		'adminEmail'=>'info@turkmenportal.com',
//		'uploadfolder'=>Yii::app()->basePath."/images/uploads",
//		'uploadfolder'=>Yii::app()->basePath."/images/uploads",
//		'watermark'=>Yii::app()->basePath."/images/watermark.jpg",
//		'no_image'=>Yii::app()->basePath."/images/no_image.jpg",
//                'cache_duration'=>0,
        'cache_duration' => 3000,

        'translatedLanguages' => array(
            'ru' => 'Russian',
            'tm' => 'Turkmen',
            'en' => 'English',
        ),
        'videoResolutions' => array(
            array('width' => 3840, 'height' => 2160),
            array('width' => 2560, 'height' => 1440),
            array('width' => 1920, 'height' => 1080),
            array('width' => 1280, 'height' => 720),
            array('width' => 854, 'height' => 480),
            array('width' => 640, 'height' => 360),
            array('width' => 426, 'height' => 240),
        ),
        'defaultLanguage' => 'ru',
        'pageSize' => 25,
        'uploadfolder' => "/images/uploads",
        'videouploadfolder' => "/images/videouploads",
//		'uploadfolder'=>"http://turkmenportal.com/images/uploads",
    ),
);