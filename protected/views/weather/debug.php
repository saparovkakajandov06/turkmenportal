<?php
/* @var $this WeatherController */

$this->breadcrumbs=array(
	Yii::t('weather', 'Weather Forecast'),
);

$current->dt =  $current->dt-3600*5+$data->timezone_offset;

$partOfDay = yii::app()->controller->partOfDay(date('H-i-s', $current->dt));

$infoPartTime = [0 => 'night', 1 => 'morn', 2 => 'day', 3 => 'eve', 4 => 'night', 5 => 'morn', 6 => 'day', 7 => 'eve', 8 => 'night'];


$todayShowPartTimes = [];
$add = false;
if (date('H:i:s', $current->dt) > '23-59-59' && date('H:i:s', $current->dt) < '02-59-59') {$one = false;} else {$one = true;}
foreach ($infoPartTime as $key => $info){
    if (date('H-i-s', $current->dt) > '23-00-00' && date('H-i-s', $current->dt) < '23-59-59' && $one) {$one = false; continue;}
    if (count($todayShowPartTimes) == 3) break;
    if ($info === $partOfDay) {$add = true; continue;}
    if ($add) $todayShowPartTimes[$key] = $info;
}

$today = YII::app()->controller->forcastWithIcons($daily[0], $hourly, $todayShowPartTimes, $timeZone);
$tomorrow = YII::app()->controller->forcastWithIcons($daily[1],$hourly, $todayShowPartTimes, $timeZone);


?>


<h1><?=YII::t('weather', 'Weather in')?> <?=$geoCodeInfo['locality']?></h1>

<div class="row">
	<div class="col-md-5">
		<div class="forecast_top">
            <div class="forecast_top_time">
                <?=yii::t('weather', 'Now') ?>
                <span class="current_time"><?=date('H:i', $current->dt)?></span>
            </div>
            <div class="forecast_top__wrap">
                <div class="forecast_top__img">
                    <img src="/themes/turkmenportal/img/weather/<?=$current->weather[0]->icon?>@2x.png" alt="<?=$current->weather[0]->description?>" width="80">
                </div>
                <div class="forecast_top__temp"><?=round($current->temp)?></div>
            </div>
            <div class="forecast_add"><?=$current->weather[0]->description?></div>
            <div class="forecast_more">
                <div class="forecast_more__item" style="display:block"><?=yii::t('weather','Feels Like')?> <?=round($current->feels_like)?>°</div>
                <div class="forecast_more__item"><?=yii::t('weather','Humidity')?> <?=$current->humidity?> %</div>
                <div class="forecast_more__item"><?=yii::t('weather','Pressure')?> <?=$current->pressure?> <?=yii::t('weather','pressure_')?></div>
                <div class="forecast_more__item"><?=yii::t('weather','Wind')?> <span class="down-icon icon_wind_s">
<!--            <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 11 11" preserveAspectRatio="xMinYMid" viewBox="0 0 11 11"><path d="M5.5 1L9 10 5.5 7.796 2 10z" fill="#b4b4b4"></path></svg>-->
       <span><i class="fa fa-location-arrow" style="transform:rotate(<?=-1*($current->wind_deg)?>deg)"></i></span> <?=round($current->wind_speed)?> <?=Yii::t('weather', 'wind_speed_')?></span> <span><?=Yii::app()->controller->wDtoText($current->wind_deg,1)?></span></div>
            </div>
        </div>
	</div>
	<div class="col-md-7 forecast_daily">
		<div class="row">
            <?php
            foreach ($todayShowPartTimes as $key => $partTime):
                if ($key < 5){
                    $weatherInfo = $today;
                    $namePartTime = $partTime;
                } else {
                    $weatherInfo = $tomorrow;
                    $namePartTime = 't'.$partTime;
                }

            ?>
                <div class="col-md-4">
                    <div class="forecast_top_d">
                        <div class="forecast_top_time">
                            <?=yii::t('weather', $namePartTime) ?>
                        </div>
                        <div class="forecast_top__wrap_d">
                            <div class="forecast_top__img_d">
                                <img src="/themes/turkmenportal/img/weather/<?=$weatherInfo->weather->$partTime->icon?>@2x.png" alt="<?=$current->weather[0]->description?>" width="60">
                            </div>
                            <div class="forecast_top__temp_d"><?=round($weatherInfo->temp->$partTime)?></div>
                        </div>
                        <div class="forecast_add_d"><?=$current->weather[0]->description?></div>
                    </div>
                </div>
            <?php
                endforeach;
            ?>
		</div>
	</div>
</div>
<hr>
<h3>Debug</h3>
<div class="row">
    <div class="col-md-12">
        <?php

        echo "<br>HTTP_CLIENT_IP<br>";
        echo $_SERVER['HTTP_CLIENT_IP'];



        echo "<br>HTTP_X_FORWARDED_FOR<br>";
        echo $_SERVER['HTTP_X_FORWARDED_FOR'];

        echo "<br>HTTP_X_FORWARDED<br>";
        echo $_SERVER['HTTP_X_FORWARDED'];


        echo "HTTP_X_CLUSTER_CLIENT_IP<br>";
        echo $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];

        echo "<br>HTTP_FORWARDED_FOR<br>";
        echo $_SERVER['HTTP_FORWARDED_FOR'];


        echo "<br>HTTP_FORWARDED <br>";
        echo $_SERVER['HTTP_FORWARDED'];


        echo 'REMOTE_ADDR: <br>';
        echo $_SERVER['REMOTE_ADDR'];


        ?>
    </div>
    <div class="col-md-12">
        <p><b>User ip adress: </b>: <?=$ip?> </p>
        <p><b>User location: </b>: <br>
            <?php
            foreach ($location as $key => $item) {
                    echo "<p><b>$key : <b/> $item</p>";
                }
            ?>
        </p>
        <p><b>User GeoCode: </b>: <br>
            <?php
            foreach ($geoCodeInfo as $key => $item) {
                echo "<p><b>$key : <b/> $item</p>";
            }
            ?>
        </p>
    </div>
</div>