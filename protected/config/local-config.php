<?php

return array(
	'name'=>'www.yashlar.gov.tm',
//        'theme'=>'yashlar',
        'theme'=>'oilgas',
        'sourceLanguage'=>'00',
	'language'=>'tm',
    
    	'import'=>array(
                'application.modules.yashlar.components.*',
                'application.modules.yashlar.controllers.*',
                'application.modules.yashlar.models.*',
	),
    
        'modules'=>array(
                'yashlar'
        ),
    
        'params'=>array(
		'uploadfolder'=>"/images/uploads",
                'no_image'=>"/images/no_image.jpg",
                'watermark'=>"/images/watermark.jpg",
            
             'translatedLanguages'=>array(
//                    'ru'=>'Russian',
                    'tm'=>'Turkmen',
                ),
                'defaultLanguage'=>'tm',
	),
    
    
);

?>