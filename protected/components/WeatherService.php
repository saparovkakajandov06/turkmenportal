<?php

class WeatherService
{

    public $apiURL ;
    public $lang;
    public $lon;
    public $lat;
    public $dt;
    public $units;
    public $apiKey;
    public $apiQ = '';
    public $data;
    public $wind_direction = 1; // 1 Direction, 0 Coordinates
    public $iconsInfo;

    private $_inHG = 33.8638866667;

    public function __construct()
    {
        $this->apiURL = Yii::app()->params['weather']['apiUrl'];
        $this->apiKey = Yii::app()->params['weather']['apiKey'];
        $this->lang = Yii::app()->params['weather']['lang'];
        $this->units = Yii::app()->params['weather']['units'];
        $this->iconsInfo = array(

            '200' => 'H6',
            '201' => 'H6',
            '202' => 'H8',
            '210' => 'H4',
            '211' => 'H4',
            '212' => 'H8',
            '221' => 'H8',
            '230' => 'H6',
            '231' => 'H6',
            '232' => 'H8',

            '300' => 'K4',
            '301' => 'K1',
            '302' => 'H6',
            '310' => 'K8',
            '311' => 'K8',
            '312' => 'K8',
            '313' => 'K8',
            '314' => 'E8',
            '321' => 'E6',

            '500' => 'D4',
            '501' => 'D6',
            '502' => 'D8',
            '503' => 'D8',
            '504' => 'D8',
            '511' => 'E8',
            '520' => 'I6',
            '521' => 'D6',
            '522' => 'I8',
            '531' => 'D8',

            '600' => 'F4',
            '601' => 'F1',
            '602' => 'F8',
            '611' => 'F1',
            '612' => 'E6',
            '613' => 'E4',
            '615' => 'E6',
            '616' => 'E8',
            '620' => 'F6',
            '621' => 'F1',
            '622' => 'F8',

            '701' => 'C1',
            '711' => 'B1',
            '721' => 'C1',
            '731' => 'C1',
            '741' => 'C1',
            '751' => 'C1',
            '761' => 'C1',
            '762' => 'C1',
            '771' => 'C1',
            '781' => 'C1',

            '800' => 'A2',
            '801' => 'A4',
            '802' => 'A6',
            '803' => 'A8',
            '804' => 'A8',

        );
    }

    public function getWeather()
    {
//        $this->getAssetsUrl();
//        Yii::app()->getClientScript()->registerCssFile($this->_assetsUrl . '/css/' . $this->cssFile);
//        Yii::app()->getClientScript()->registerScriptFile($this->_assetsUrl . '/js/' . $this->jsFile);
        if (!is_dir(Yii::getPathOfAlias('application.runtime.OpenWeather'))) {
            mkdir(Yii::getPathOfAlias('application.runtime.OpenWeather'));
        }
        setlocale(LC_MESSAGES, Yii::app()->language . '_' . strtoupper(Yii::app()->language));
        bindtextdomain("openweather", Yii::getPathOfAlias('application.widgets.OpenWeather.i18n'));
        textdomain("openweather");
        $date = new DateTime();
        if (!is_file(Yii::getPathOfAlias('application.runtime.OpenWeather') . '/'.$this->apiQ.$this->dt.$this->lat.$this->lon.'openweather.json') || (time() - filemtime(Yii::getPathOfAlias('application.runtime.OpenWeather') .'/'. $this->apiQ.$this->dt.$this->lat.$this->lon.'openweather.json')) > 300) {

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


    public function getGeoCode()
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


    public function  wDtoText($degree, $short = true){

        $info = array(
            0 => array(
                'en' => array('North', 'North West', 'West', 'South West', 'South', 'South East', 'East', 'North East'),
                'ru' => array('Север', 'Северо-запад', 'Запад', 'Юго-запад', 'Юг', 'Юго-восток', 'Восток', 'Северо-восток'),
                'tk' => array('Demirgazyk', 'Demirgazyk-Günbatar', 'Günbatar', 'Günorta-Günbatar', 'Günorta', 'Günorta-Gündogar', 'Gündogar', 'Demirgazyk-Gündogar'),
            ),
            1 => array(
                'en' => array('N', 'NW', 'W', 'SW', 'S', 'SE', 'E', 'NE'),
                'ru' => array('С', 'СЗ', 'З', 'ЮЗ', 'Ю', 'ЮВ', 'В', 'СВ'),
                'tk' => array('D', 'DG', 'G', 'GG', 'G', 'GG', 'G', 'DG'),
            )
        );
        if ($short){
            $select = 1;
        } else {
            $select = 0;
        }
        $lang = Yii::app()->language;
        if ($degree>337.5){
            return $info[$select][$lang][0];
        }
        if ($degree>292.5) {
            return $info[$select][$lang][1];
        }
        if($degree>247.5) {
            return $info[$select][$lang][2];
        }
        if($degree>202.5){
            return $info[$select][$lang][3];
        }
        if($degree>157.5){
            return $info[$select][$lang][4];
        }
        if($degree>122.5){
            return $info[$select][$lang][5];
        }
        if($degree>67.5){
            return $info[$select][$lang][6];
        }
        if($degree>22.5){
            return $info[$select][$lang][7];
        }
        return $info[$select][$lang][0];

    }


    public function getUserLocation($ip)
    {
        $criteria = New CDbCriteria();
        $criteria->addCondition(new CDbExpression('ip =:ip'));
        $criteria->params=array('ip'=>$ip);
        $model = UserLocations::model()->find($criteria);

        if (!isset($model)){

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => "https://ip-geolocation-ipwhois-io.p.rapidapi.com/json/".$ip,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
//                CURLOPT_PROXY => '104.236.82.228',
//                CURLOPT_PROXYPORT => '4455',
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => [
                    "x-rapidapi-host: ip-geolocation-ipwhois-io.p.rapidapi.com",
                    "x-rapidapi-key: 1649c3a1cfmshc85c50924650c9dp15d821jsn463a6545f164"
                ],
            ]);

            $response = curl_exec($curl);

            $err = curl_error($curl);

            curl_close($curl);
            $result = json_decode($response);

            $model = new UserLocations();
            $relation = new LocationsInfo();

            foreach ($result as $key => $value){
                if ($model->hasAttribute($key)){
                    $model->$key = $value;
                } elseif ($relation->hasAttribute($key)){
                    $relation->$key = $value;
                }
            }

            $content = file_get_contents($relation->country_flag);

            $relation->country_flag = $relation->country_code.'.svg';

            $uploadfolder = trim(Yii::app()->params['uploadfolder'], '/');

            file_put_contents($uploadfolder.'/country_flags/'.$relation->country_code.'.svg', $content);

            $model->locationInfo = $relation;

            $model->saveWithRelated(array('locationInfo'));

        }



        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $model;
        }
    }


    public function partOfDay($time)
    {
        if ($time >= '03-00-00' && $time <= '11-59-59') return 'morn';
        if ($time >= '12-00-00' && $time <= '16-59-59') return 'day';
        if ($time >= '17-00-00' && $time <= '22-59-59') return 'eve';
        if ($time >= '23-00-00' && $time <= '23-59-59') return 'night';
        if ($time >= '00-00-00' && $time <= '02-59-59') return 'night';
    }


    public function forcastWithIcons($day, $info, $todayShowPartTimes, $timeZone)
    {

        $clockPartTime = ['night' => '01:00:00', 'morn' => '08:00:00', 'day' => '14:00:00', 'eve' => '19:00:00'];
        unset($day->weather);
        foreach ($todayShowPartTimes as $key => $partTime) {
            $date = date('Y-m-d', $day->dt);
            $time = strtotime($date.' '.$clockPartTime[$partTime]);
            if ($partTime === 'night') $time = $time + 24*60*60;
            foreach ($info as $i){
                if ($i->dt == $time){
                    $day->weather->$partTime->id = $i->weather[0]->id;
                    $day->weather->$partTime->main = $i->weather[0]->main;
                    $day->weather->$partTime->description = $i->weather[0]->description;
                    $day->weather->$partTime->icon = $i->weather[0]->icon;
                }
            }
        }
        return $day;
    }

}