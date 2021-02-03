<?php
/* @var $this WeatherController */

$this->breadcrumbs=array(
	Yii::t('weather', 'Weather Forecast'),
);

$today = clone $daily[0];
$tomorrow = clone $daily[1];

$current->dt =  $current->dt-3600*5+$data->timezone_offset;

$partOfDay = yii::app()->controller->partOfDay(date('H-i-s', $current->dt));

$infoPartTime = [0 => 'night', 1 => 'morn', 2 => 'day', 3 => 'eve', 4 => 'night', 5 => 'morn', 6 => 'day', 7 => 'eve', 8 => 'night'];

//echo "<pre>";
//var_dump($daily[0]->weather[0]->icon);die;

$todayShowPartTimes = [];
$add = false;
if (date('H:i:s', $current->dt) > '23-59-59' && date('H:i:s', $current->dt) < '02-59-59') {$one = false;} else {$one = true;}
foreach ($infoPartTime as $key => $info){
    if (date('H-i-s', $current->dt) > '23-00-00' && date('H-i-s', $current->dt) < '23-59-59' && $one) {$one = false; continue;}
    if (count($todayShowPartTimes) == 3) break;
    if ($info === $partOfDay) {$add = true; continue;}
    if ($add) $todayShowPartTimes[$key] = $info;
}

$today = YII::app()->controller->forcastWithIcons($today, $hourly, $todayShowPartTimes, $timeZone);
$tomorrow = YII::app()->controller->forcastWithIcons($tomorrow,$hourly, $todayShowPartTimes, $timeZone);

?>

<div class="weather_wrapper">
    <div class="top_weather">
        <div class="current_weather">
            <div class="cw_top">
                <h1><?=Yii::t('weather', 'Now')?>, Aşgabat</h1>
                <div class="dropdown other_cities_block">
                    <a href="#" class="dropdown-toggle " type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       Other cities
                        <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu other_cities_list" aria-labelledby="dropdownMenu2">
                        <ul class="list-unstyled">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">hello</a></li>
                            <li><a href="#">Action</a></li>
                            <li><a href="#">hello</a></li>
                            <li><a href="#">Something  </a></li>
                        </ul>
                        <ul class="list-unstyled">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Action</a></li>
                            <li><a href="#">hello</a></li>
                            <li><a href="#">Something  </a></li>
                        </ul>
                        <ul class="list-unstyled">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Action</a></li>
                            <li><a href="#">hello</a></li>
                            <li><a href="#">Something  </a></li>
                        </ul>

                    </div>
                </div>
            </div>
            <div class="current_weather_caption">
                <img src="/themes/turkmenportal/img/weather/<?=$current->weather[0]->icon?>@2x.png" alt="" >
                <div class="current_weather_info">
                    <span class="cwp_val deg"><?=round($current->temp)?></span>
                    <span><?=$current->weather[0]->description?></span>
                    <span class="deg"><?=yii::t('weather','Feels Like')?> <?=round($current->feels_like)?></span>
                    <span class="deg"><?=yii::t('weather','Humidity')?> <?=$current->humidity?> %</span>
                    <span><?=yii::t('weather','Pressure')?> <?=$current->pressure?> <?=yii::t('weather','pressure_')?></span>
                    <span>
                        <?=yii::t('weather','Wind')?>
                        <i class="fa fa-location-arrow" style="transform:rotate(<?=-1*($current->wind_deg)?>deg)"></i>
                        <?=round($current->wind_speed)?>
                        <?=Yii::t('weather', 'wind_speed_')?>
                        <?=Yii::app()->controller->wDtoText($current->wind_deg,1)?>
                    </span>
                </div>
            </div>
        </div>
        <div class="part_of_day_weahter">

            <?php
            foreach ($todayShowPartTimes as $key => $partTime):
                if ($key < 5){
                    $weatherInfo = $today;
                    $namePartTime = $partTime;
                } else {
                    $weatherInfo = $tomorrow;
                    $namePartTime = 't '.$partTime;
                }

                ?>
                <div class="part_of_day">
                    <div class="pod_w_caption">
                        <h4><?=yii::t('weather', $namePartTime) ?></h4>
                        <span class="weather_degree deg">
                            <?=round($weatherInfo->temp->$partTime)?>
                        </span>
                    </div>
                    <div class="pod_w_icon">
                        <img src="/themes/turkmenportal/img/weather/<?=$weatherInfo->weather->$partTime->icon?>@2x.png" alt="">
                    </div>
                </div>
            <?php
            endforeach;
            ?>
        </div>
    </div>

    <div class="daily_weather">

        <?php
            $i = 0;

            foreach ($daily as $item){
                $i++;
                if ($i == 8) break;
                $dToday = date('Y:m:d');
                if (date('Y:m:d',$item->dt) === $dToday) continue;


            ?>

                <div class="dw_item">
                    <h4 class="day_of_week"><?=Yii::app()->controller->renderDateWeekDay($item->dt)?> <br> <span class="date_day"><?=date('j',$item->dt)?></span></h4>
                    <img src="/themes/turkmenportal/img/weather/<?=$item->weather[0]->icon?>@2x.png" alt="">
                    <span class="value deg"><?=round($item->temp->min)?>...<?=round($item->temp->max)?></span>
                    <span class="w_wind">
                        <i class="fa fa-location-arrow" style="transform:rotate(<?=-1*($item->wind_deg)?>deg)"></i>
                        <?=round($item->wind_speed)?>
                        <?=Yii::app()->controller->wDtoText($item->wind_deg,1)?>
                        <?=Yii::t('weather', 'wind_speed_')?>
                    </span>
                    <span class="w_pressure"><?=yii::t('weather','Pressure')?> <?=$item->pressure?> <?=yii::t('weather','pressure_')?></span>
                    <span class="w_humidity"><?=yii::t('weather', 'Humidity')?> <?=$item->humidity?> %</span>
                </div>
                <?php

            }

        ?>

    </div>
</div>