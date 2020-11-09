<?php
Yii::import('application.vendors.IXR_Library', true);
 
class DRPCManager extends CApplicationComponent
{
    public $pingEnable = true;
    public $pingServers = array();
 
    public function pingPage($pageURL)
    {
 
        $siteName = Yii::app()->name;
        $siteHost = Yii::app()->request->getHostInfo();
//        $fullPageUrl = $siteHost . $pageURL;
        $fullPageUrl = $pageURL;
 
        if ($this->pingEnable)
        {
            if (!$pageURL)
                return;
 
            foreach ($this->pingServers as $serverUrl)
            {
                if (preg_match('|(?P<host>\w+://[\w\.-]+)/?(?P<uri>.*)|i', $serverUrl, $matches))
                {
                    $client = new IXR_Client($matches['host'], $matches['uri']);
//                    echo "<pre>";
//                    print_r($siteName);
//                    echo "</br>";
//                    print_r($siteHost);
//                    echo "</br>";
//                    print_r($fullPageUrl);
//                    echo "</pre>";
//                    Yii::app()->end();
                    if (!$client->query('weblogUpdates.ping', array($siteName, $siteHost, $fullPageUrl)))
                        Yii::log('Ping error for ' . $serverUrl, CLogger::LEVEL_WARNING);
                }
            }
        } else
            Yii::log('Emulation of ping for ' . $fullPageUrl);
    }
}

?>

