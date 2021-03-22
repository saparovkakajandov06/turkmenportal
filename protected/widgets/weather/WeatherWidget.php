<?php


class WeatherWidget extends \CWidget
{
    public $view = 'weather';
    
    public function init()
    {
        parent::init();

        
    }


    public function run()
    {
        $model = InfoCities::model()->findByPk(1290);


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

        $night = false;
        if ($current->dt < $current->sunrise || $current->dt > $current->sunset) {
            $night = true;
        };
        
        $this->render($this->view, [
            'current' => $current,
            'weather' => $weather,
            'model' => $model,
        ]);
    }






    
    

}
