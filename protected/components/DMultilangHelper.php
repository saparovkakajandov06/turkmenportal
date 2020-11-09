<?php

class DMultilangHelper
{
    public static function enabled()
    {
        return count(Yii::app()->params['translatedLanguages']) > 1;
    }
 
    
    public static function suffixList()
    {
        $list = array();
        $enabled = self::enabled();
 
        foreach (Yii::app()->params['translatedLanguages'] as $lang => $name)
        {
            if ($lang === Yii::app()->params['defaultLanguage']) {
                $suffix = '';
                $list[$suffix] = $enabled ? $name : '';
            } else {
                $suffix = '_' . $lang;
                $list[$suffix] = $name;
            }
        }
 
        return $list;
    }
 
    public static function processLangInUrl($url)
    {
        if (self::enabled()) {
			
                $index = self::_getLangIndex();
                $domains = explode('/', ltrim($url, '/'));
                
         
                $isLangExists = in_array($domains[$index], array_keys(Yii::app()->params['translatedLanguages']));
                $isDefaultLang = $domains[$index] == Yii::app()->params['defaultLanguage'];

                if ($isLangExists && !$isDefaultLang) {
                        Yii::app()->setLanguage($domains[$index]);
                        array_splice($domains, $index, 1);
                }

                $url = '/' . implode('/', $domains);
        }
     
        return $url;
    }
    
    
    
 
    public static function addLangToUrl($url)
    {
        
        if (self::enabled()) {

                $index = self::_getLangIndex();
                $domains = explode('/', ltrim($url, '/'));

                $isHasLang = in_array($domains[$index], array_keys(Yii::app()->params['translatedLanguages']));
                $isDefaultLang = Yii::app()->getLanguage() == Yii::app()->params['defaultLanguage'];

                
                if ($isHasLang && $isDefaultLang)
                        array_splice($domains, $index, 1);

                if (!$isHasLang && !$isDefaultLang)
                        array_splice($domains, $index, 0, Yii::app()->getLanguage());

                
                $url = '/' . implode('/', $domains);
        }
        
        return $url;
    }
    
    
    public static function addSpecificLangToUrl($url,$lang)
    {
        
        if (self::enabled()) {

                $index = self::_getLangIndex();
                $domains = explode('/', ltrim($url, '/'));

                $isHasLang = in_array($domains[$index], array_keys(Yii::app()->params['translatedLanguages']));
                $isDefaultLang = $lang == Yii::app()->params['defaultLanguage'];

                
                if ($isHasLang && $isDefaultLang){
                        array_splice($domains, $index, 1);
                }
                
                if (!$isHasLang && !$isDefaultLang){
                    array_splice($domains, $index, 0, $lang);
                }
                
                $url = '/' . implode('/', $domains);
        }
        return $url;
    }
    
    
    
    public static function _getLangIndex()
    {
            $index = 0;

            $baseUrl = ltrim(Yii::app()->getBaseUrl(), '/');
            
            if (strlen($baseUrl))
            {
                    $baseUrlChunks = explode('/', $baseUrl);
                    if (count($baseUrlChunks) > 0)
                            $index = count($baseUrlChunks);
            }

            return $index;
    }
}
?>