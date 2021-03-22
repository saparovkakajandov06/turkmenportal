<?php

class WeathersController extends Controller
{


    public function actionIndex()
    {
        $cities = New InfoCities();

        if (!isset($id)){
            $model = InfoCities::model()->findByPk(1290);
        }

        $weather = new WeatherService();


        if (isset($model)){
            $weather->lat = $model->lat;
            $weather->lon = $model->lon;
        }

        $weatherData  = $weather->getWeather();


        $weatherData = json_decode($weatherData);


        if (isset($weatherData->current)){
            $current = $weatherData->current;
        }
        if (isset($weatherData->hourly)){
            $hourly = $weatherData->hourly;
        }
        if (isset($weatherData->daily)){
            $daily = $weatherData->daily;
        }
        $night = false;
        if ($current->dt < $current->sunrise || $current->dt > $current->sunset) {
            $night = true;
        };


        $today = clone $daily[0];
        $tomorrow = clone $daily[1];

        $todayShowPartTimes = $weather->todayShowPartTimes($current, $weatherData->timezone_offset);

        $today = $weather->forcastWithIcons($today, $hourly, $todayShowPartTimes);
        $tomorrow = $weather->forcastWithIcons($tomorrow,$hourly, $todayShowPartTimes);


        $data['weatherData'] = $weatherData;

        if (isset($weatherData)){

            if (!isset($data)){
                $data['weatherData'] = [];
            }

            header('Content-Type: application/json; charset=UTF-8');
            echo Json::encode($data);die;


        } else {
            $this->render('error', array(
            ));
        }
    }



    public function actionView($id)
    {

        $model = InfoCities::model()->findByPk($id);

        $weahter = new WeatherService();


        if (isset($model)){
            $weahter->lat = $model->lat;
            $weahter->lon = $model->lon;
        }

        $weatherData  = $weahter->getWeather();

        $weatherData = json_decode($weatherData);


        if (isset($weatherData->current)){
            $current = $weatherData->current;
        }
        if (isset($weatherData->hourly)){
            $hourly = $weatherData->hourly;
        }
        if (isset($weatherData->daily)){
            $daily = $weatherData->daily;
        }

        $night = false;
        if ($current->dt < $current->sunrise || $current->dt > $current->sunset) {
            $night = true;
        };



        $data['weatherData'] = $weatherData;

        if (isset($weatherData)){

            if (!isset($data)){
                $data['weatherData'] = [];
            }

            header('Content-Type: application/json; charset=UTF-8');
            echo Json::encode($data);die;


        } else {
            $this->render('error', array(
            ));
        }

    }

    public function actionCities()
    {
        $cities = New InfoCities();

        $topCities = $cities->selectVisibility();
        $topCities = $topCities->getData();

        foreach ($topCities as $topCity) {
            $data['cities'][] = [
                'id' => $topCity->id,
                'citi_name' => $topCity->citi_name,
                'name_tm' => $topCity->name_tm,
                'name_ru' => $topCity->name_ru,
                'name_en' => $topCity->name_en,
                'country_tm' => $topCity->country_tm,
                'country_ru' => $topCity->country_ru,
                'country_en' => $topCity->country_en,
            ];
        }

        if (!isset($data)){
            $data['cities'] = [];
        }

        header('Content-Type: application/json; charset=UTF-8');
        echo Json::encode($data);die;
    }

}