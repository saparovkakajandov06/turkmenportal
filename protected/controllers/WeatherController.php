<?php

class WeatherController extends Controller
{
    public function filters()
    {
        return array('rights',);
    }

	public function actionView($id)
	{
        $this->layout = '//layouts/weather/weatherColumn';

        $cities = New InfoCities();

        if (!isset($id)){
            $model = InfoCities::model()->findByPk(1290);
        } else
        $model = InfoCities::model()->findByPk($id);

        if ($model === null ||  $model->visibility == 0 || $model->status == 0)
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));


        $weahter = new WeatherService();


        if (isset($model)){
            $weahter->lat = $model->lat;
            $weahter->lon = $model->lon;
        }

        $topCities = $cities->selectVisibility();
        $topCities = $topCities->getData();


        $listCities = $cities->selectVisibility('list');
        $listCities = $listCities->getData();


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
        if (isset($weatherData->alerts)){
            $alerts = $weatherData->alerts;
        }
        if (isset($weatherData->minutely)){
            $minutely = $weatherData->minutely;
        }
        $night = false;
        if ($current->dt < $current->sunrise || $current->dt > $current->sunset) {
            $night = true;
        };



        if (!isset($data)){
            $this->render('index', array(
                'data' => $weatherData,
                'current' => $current,
                'hourly'=> $hourly,
                'daily' => $daily,
                'alerts' => $alerts,
                'model' => $model,
                'listCities' => $listCities,
                'topCities' => $topCities,
                'weather' => $weahter,
            ));
        } else {
            $this->render('error', array(
            ));
        }

	}

}