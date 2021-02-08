<?php
/* @var $this WeatherController */
$iconsInfo  = array(

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
    '804' => 'A10',

);
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


$id  = $current->weather[0]->id;
if (substr($current->weather[0]->icon,-1) === 'n'){
    $icon = $iconsInfo[$id].'n';
} else {
    $icon = $iconsInfo[$id].'d';
}

?>

<div class="row">
    <div class="col-md-8">
        <div class="top_weather">
            <div class="current_weather">
                <div class="cw_top">
                    <h1><?=Yii::t('weather', 'Now')?>, <?=$model->getName()?></h1>
                    <div class="dropdown other_cities_block">
                        <a href="#" class="dropdown-toggle " type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?=yii::t('weather', 'Other cities')?>
                            <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu other_cities_list" aria-labelledby="dropdownMenu2">
                            <?php
                                $sum = 0;
                                $delimiter = 5;
                                $count = count($topCities);
                                foreach ($topCities  as $key => $city):
                                if ($key == 0 || $key === $sum){
                                    $sum += $delimiter;
                                    echo "<ul class='list-unstyled'>";
                                }

                            ?>
                                <li><?=CHtml::link($city->getName(),'?city='.$city->id)?></li>

                            <?php
                                if ($key == $sum-1 || $key == $count-1){
                                    echo "</ul>";
                                }
                                endforeach;
                            ?>

                        </div>
                    </div>
                </div>
                <div class="current_weather_caption">
                    <img src="/themes/turkmenportal/img/weatherIcon/<?=$icon?>.png" alt="" >
                    <div class="current_weather_info">
                        <span class="cwp_val deg"><?=round($current->temp)?>&deg;</span>
                        <span><?=$current->weather[0]->description?></span>
                        <span class="deg"><?=yii::t('weather','Feels Like')?> <b><?=round($current->feels_like)?></b>&deg;</span>
                        <span><?=yii::t('weather','Humidity')?> <b><?=$current->humidity?> %</b></span>
                        <span><?=yii::t('weather','Pressure')?> <b><?=$current->pressure?></b> <?=yii::t('weather','pressure_')?></span>
                        <span>
                        <?=yii::t('weather','Wind')?>
                            <i class="fa fa-location-arrow" style="transform:rotate(<?=-1*($current->wind_deg)?>deg)"></i>
                            <b><?=round($current->wind_speed)?></b>
                            <?=Yii::t('weather', 'wind_speed_')?>
                            <?=Yii::app()->controller->wDtoText($current->wind_deg,1)?>
                    </span>
                    </div>
                </div>
            </div>
            <div class="part_of_day_weahter">
                <div class="text-center">
                    <h4><?=Yii::t('app', 'today')?></h4>
                    <h5><?=yii::app()->controller->renderDateToWord(time(), false)?></h5>
                </div>
                <?php
                foreach ($todayShowPartTimes as $key => $partTime):
                    if ($key < 5){
                        $weatherInfo = $today;
                        $namePartTime = $partTime;
                    } else {
                        $weatherInfo = $tomorrow;
                        $namePartTime = 't '.$partTime;
                    }
                    $id  = $weatherInfo->weather->$partTime->id;
                    if (substr($weatherInfo->weather->$partTime->icon,-1) === 'n'){
                        $icon = $iconsInfo[$id].'n';
                    } else {
                        $icon = $iconsInfo[$id].'d';
                    }

                    ?>
                    <div class="part_of_day">
                        <div class="pod_w_caption">
                            <h5><?=yii::t('weather', $namePartTime) ?></h5>
                            <span class="weather_degree deg">
                            <b><?=round($weatherInfo->temp->$partTime)?></b>&deg;
                        </span>
                        </div>
                        <div class="pod_w_icon">
                            <img src="/themes/turkmenportal/img/weatherIcon/<?=$icon?>.png" alt="">
                        </div>
                    </div>
                <?php
                endforeach;
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
                <?php $this->renderPartial('/layouts/weather/weatherColumnSidebar'); ?>
    </div>
</div>


<div class="row daily_weather_bg_color">
    <div class="weather_wrapper">
        <div class="daily_weather">

            <?php
            $i = 0;

            foreach ($daily as $item){
                $i++;
                if ($i == 8) break;
                $dToday = date('Y:m:d');
                if (date('Y:m:d',$item->dt) === $dToday) continue;

                $id  = $item->weather[0]->id;
                if (substr($item->weather[0]->icon,-1) === 'n'){
                    $icon = $iconsInfo[$id].'n';
                } else {
                    $icon = $iconsInfo[$id].'d';
                }

                $feels_likeMax = $item->feels_like->day;
                $feels_likeMin = $item->feels_like->day;

                foreach ($item->feels_like as $fl){
                    if ($feels_likeMax < $fl) $feels_likeMax = $fl;
                    if ($feels_likeMin > $fl) $feels_likeMin = $fl;
                }

                ?>

                <div class="dw_item">
                    <h3 class="day_of_week"><?=Yii::app()->controller->renderDateWeekDay($item->dt)?> <br> <span class="date_day"><?=date('j.m',$item->dt)?></span></h3>
                    <img src="/themes/turkmenportal/img/weatherIcon/<?=$icon?>.png" alt="">
                    <h1 class="value deg"><?=round($item->temp->min)?>...<?=round($item->temp->max)?>&deg;</h1>
                    <h3 class="feels_like deg"><span style="font-size: 15px;font-weight: 100;"></span><?=round($feels_likeMin)?>...<?=round($feels_likeMax)?>&deg;</h3>
                    <span class="w_wind">
                        <i class="fa fa-location-arrow" style="transform:rotate(<?=-1*($item->wind_deg)?>deg)"></i>
                    <b><?=round($item->wind_speed)?></b>
                        <?=Yii::app()->controller->wDtoText($item->wind_deg,1)?>
                        <?=Yii::t('weather', 'wind_speed_')?>
                    </span>
                    <span class="w_pressure"><?=yii::t('weather','Pressure')?> <b><?=$item->pressure?></b> <?=yii::t('weather','pressure_')?></span>
                    <span class="w_humidity"><?=yii::t('weather', 'Humidity')?> <b><?=$item->humidity?></b> %</span>
                </div>
                <?php

            }

            ?>

        </div>
    </div>
</div>