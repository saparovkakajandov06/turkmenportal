<?php

class WeatherController extends Controller
{
    public $apiURL = 'https://api.openweathermap.org/data/2.5/onecall?';
    public $lang = 'ru';
    public $lon = 58.3833;
    public $lat = 37.95;
    public $dt;
    public $units = 'metric';
    public $apiKey = '12bb3e427d6f3a29cd3b086cd5a221b8';
    public $apiQ = '';
    public $data;
    public $cssFile = 'openweather.css';
    public $jsFile = 'openweather.js';
    public $view = 'weather1';
    public $wind_direction = 1; // 1 Direction, 0 Coordinates

    private $_assetsUrl;
    private $_inHG = 33.8638866667;


    public function filters()
    {
        return array('rights',);
    }


    public function getAssetsUrl()
    {
        if ($this->_assetsUrl === null) {
            $this->_assetsUrl = Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.widgets.openWeather.assets'), false, -1, true);
        }
        return $this->_assetsUrl;
    }


	public function actionIndex()
	{
        $this->layout = '//layouts/weather/weatherColumn';

        if (Yii::app()->language !== 'tm'){
            $this->lang = Yii::app()->language;
        } else {
            $this->lang = 'en';
        }

        $ip = yii::app()->controller->getRealIp();

//        locally
//        $ip = '185.69.185.239';
        $location = yii::app()->controller->getUserLocation($ip);

        $this->lat  = $location->latitude;
        $this->lon  = $location->longitude;


        $geoCodeInfo = $this->getGeoCode();


        if (Yii::app()->language !== 'tm'){
            $this->lang = Yii::app()->language;
        } else {
            $this->lang = 'en';
        }

        $weahter = $this->getWeather();

        $this->data = json_decode($weahter);


        if (isset($this->data->current)){
            $current = $this->data->current;
        }
        if (isset($this->data->hourly)){
            $hourly = $this->data->hourly;
        }
        if (isset($this->data->daily)){
            $daily = $this->data->daily;
        }
        if (isset($this->data->alerts)){
            $alerts = $this->data->alerts;
        }
        if (isset($this->data->minutely)){
            $minutely = $this->data->minutely;
        }
        $night = false;
        if ($current->dt < $current->sunrise || $current->dt > $current->sunset) {
            $night = true;
        };

//
//        echo "<pre>";
//        var_dump($current);die;


        $this->render('index', array(
            'geoCodeInfo' => $geoCodeInfo,
            'data' => $this->data,
            'current' => $current,
            'hourly'=> $hourly,
            'daily' => $daily,
            'alerts' => $alerts,
//            'minutely' => $minutely
        ));
	}


	private function getWeather()
    {
        $this->getAssetsUrl();
        Yii::app()->getClientScript()->registerCssFile($this->_assetsUrl . '/css/' . $this->cssFile);
        Yii::app()->getClientScript()->registerScriptFile($this->_assetsUrl . '/js/' . $this->jsFile);
        if (!is_dir(Yii::getPathOfAlias('application.runtime.OpenWeather'))) {
            mkdir(Yii::getPathOfAlias('application.runtime.OpenWeather'));
        }
        setlocale(LC_MESSAGES, Yii::app()->language . '_' . strtoupper(Yii::app()->language));
        bindtextdomain("openweather", Yii::getPathOfAlias('application.widgets.OpenWeather.i18n'));
        textdomain("openweather");
        $date = new DateTime();
        if (!is_file(Yii::getPathOfAlias('application.runtime.OpenWeather') . '/'.$this->apiQ.$this->dt.$this->lat.$this->lon.'openweather.json') || (time() - filemtime(Yii::getPathOfAlias('application.runtime.OpenWeather') .'/'. $this->apiQ.$this->dt.$this->lat.$this->lon.'openweather.json')) > 60) {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $this->apiURL . 'lat='.$this->lat .'&lon='. $this->lon.'&units='.$this->units. '&appid=' . $this->apiKey. '&lang=' . $this->lang);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

//           locally
//            curl_setopt($curl, CURLOPT_PROXY, '104.236.82.228');
//            curl_setopt($curl, CURLOPT_PROXYPORT, '4455');


            $data = curl_exec($curl);
            if (curl_getinfo($curl, CURLINFO_HTTP_CODE) === 401) {
                throw new CException(Yii::t('Access to OpenWeather denied. You need a valid API Key for works'));
            }
            file_put_contents(Yii::getPathOfAlias('application.runtime.OpenWeather') . '/'.$this->apiQ.$this->dt.$this->lat.$this->lon.'openweather.json', $data);
        } else {
            $data = file_get_contents(Yii::getPathOfAlias('application.runtime.OpenWeather') . '/'.$this->apiQ.$this->dt.$this->lat.$this->lon.'openweather.json');
        }

        return $data;
    }


    private function getGeoCode()
    {
        $geocode=file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyBDJ1dE9OjJtp33gBzRMad6iasRnAW_4xQ&language='.$this->lang.'&latlng='.$this->lat.','.$this->lon.'&sensor=false');
        $output= json_decode($geocode);

        if ($this->lang === 'ru'){
            if (isset($output->results[2])){
                $results = $output->results[2]->address_components;
            } elseif (isset($output->results[1])){
                $results = $output->results[1]->address_components;
            }
        } else {
            $results = $output->results[0]->address_components;
        }



        foreach ($results as $result){
            $geoCodeInfo[$result->types[0]] = $result->long_name;
        }

        return $geoCodeInfo;

    }


    public function actionDebug()
    {
        $this->layout = '//layouts/weather/weatherColumn';

        if (Yii::app()->language !== 'tm'){
            $this->lang = Yii::app()->language;
        } else {
            $this->lang = 'en';
        }

        $ip = yii::app()->controller->getUserIp();

//        locally
//        $ip = '185.69.185.239';
        $location = yii::app()->controller->getUserLocation($ip);

        $this->lat  = $location->latitude;
        $this->lon  = $location->longitude;


        $geoCodeInfo = $this->getGeoCode();


        if (Yii::app()->language !== 'tm'){
            $this->lang = Yii::app()->language;
        } else {
            $this->lang = 'en';
        }

        $weahter = $this->getWeather();

        $this->data = json_decode($weahter);


        if (isset($this->data->current)){
            $current = $this->data->current;
        }
        if (isset($this->data->hourly)){
            $hourly = $this->data->hourly;
        }
        if (isset($this->data->daily)){
            $daily = $this->data->daily;
        }
        if (isset($this->data->alerts)){
            $alerts = $this->data->alerts;
        }
        if (isset($this->data->minutely)){
            $minutely = $this->data->minutely;
        }
        $night = false;
        if ($current->dt < $current->sunrise || $current->dt > $current->sunset) {
            $night = true;
        };


        $this->render('debug', array(
            'ip' => $ip,
            'location' => $location,
            'geoCodeInfo' => $geoCodeInfo,
            'data' => $this->data,
            'current' => $current,
            'hourly'=> $hourly,
            'daily' => $daily,
            'alerts' => $alerts,
//            'minutely' => $minutely
        ));
    }



}