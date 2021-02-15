<?php
/* @var $this WeatherController */

$this->breadcrumbs=array(
	Yii::t('weather', 'Weather Forecast'),
);

$pageTitle = yii::t('weather', '_title');

$this->pageTitle = yii::t('weather', '_title');
$this->meta_description = yii::t('weather', '_description');
$this->meta_keyword = yii::t('weather', '_keyword');


$today = clone $daily[0];
$tomorrow = clone $daily[1];

$todayShowPartTimes = $weather->todayShowPartTimes($current, $data->timezone_offset);

$today = $weather->forcastWithIcons($today, $hourly, $todayShowPartTimes);
$tomorrow = $weather->forcastWithIcons($tomorrow,$hourly, $todayShowPartTimes);


$currentId  = $current->weather[0]->id;
if (substr($current->weather[0]->icon,-1) === 'n'){
    $icon = $weather->iconsInfo[$currentId].'n';
} else {
    $icon = $weather->iconsInfo[$currentId].'d';
}
?>

<div class="row hidden-xs hidden-sm">
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
                                $url = $city->getUrl();
                                if ($_GET['id'] !== $city->id){
                            ?>
                                <li><?=CHtml::link($city->getName(),$url)?></li>

                                <?php
                                }
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
                        <span class="fLU"><?=Yii::t('weather', $current->weather[0]->id)?></span>
                        <span class="deg"><?=yii::t('weather','Feels Like')?> <b><?=round($current->feels_like)?></b>&deg;</span>
                        <span><?=yii::t('weather','Humidity')?> <b><?=$current->humidity?> %</b></span>
                        <span><?=yii::t('weather','Pressure')?> <b><?=$current->pressure?></b> <?=yii::t('weather','pressure_')?></span>
                        <span>
                        <?=yii::t('weather','Wind')?>
                            <i class="fa fa-location-arrow" style="transform:rotate(<?=-1*($current->wind_deg)?>deg)"></i>
                            <b><?=round($current->wind_speed)?></b>
                            <?=Yii::t('weather', 'wind_speed_')?>
                            <?=$weather->wDtoText($current->wind_deg,1)?>
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
                        $icon = $weather->iconsInfo[$id].'n';
                    } else {
                        $icon = $weather->iconsInfo[$id].'d';
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
        <?php if (!$this->isMobile()) { ?>
            <?php
            $this->widget('application.widgets.banners.BannersWidget', array(
                'type' => 'bannerWeatherAdsense',
            ));
            ?>
        <?php } ?>
    </div>
</div>


<div class="row daily_weather_bg_color hidden-xs hidden-sm">
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
                    $icon = $weather->iconsInfo[$id].'n';
                } else {
                    $icon = $weather->iconsInfo[$id].'d';
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
                        <?=Yii::t('weather', 'Wind')?>
                        <i class="fa fa-location-arrow" style="transform:rotate(<?=-1*($item->wind_deg)?>deg)"></i>
                    <b><?=round($item->wind_speed)?></b>
                        <?=$weather->wDtoText($item->wind_deg,1)?>
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



<div class="row hidden-md hidden-lg">
    <?php if ($this->isMobile()) { ?>
       <div class="col-xs-12">
           <?php
           $this->widget('application.widgets.banners.BannersWidget', array(
               'type' => 'mobileBannerWeatherAdsense',
           ));
           ?>
       </div>
    <?php } ?>

    <div class="col-md-12 py-10">
        <h3 class="mt-0 mb-5"><?=$model->getName()?></h3>
        <div class="dropdown other_cities_block">
            <span><?=yii::app()->controller->renderDateWeekDay3l($current->dt)?>, <?=yii::app()->controller->renderDateToWord($current->dt, false)?></span>
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
                    $url = $city->getUrl();
                    ?>
                    <li><?=CHtml::link($city->getName(),$url)?></li>

                    <?php
                    if ($key == $sum-1 || $key == $count-1){
                        echo "</ul>";
                    }
                endforeach;

                if (substr($current->weather[0]->icon,-1) === 'n'){
                    $icon = $weather->iconsInfo[$currentId].'n';
                } else {
                    $icon = $weather->iconsInfo[$currentId].'d';
                }
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-12 br-y-grey py-10">
        <div class="m_current_weather_info">
            <span class="m_c_w_val deg">
                <span>
                <b><?=round($current->temp)?>&deg;</b>
                </span>
            </span>
            <span class="m_w_icon">
                <img src="/themes/turkmenportal/img/weatherIcon/<?=$icon?>.png" alt="<?=$current->weather[0]->description?>">
            </span>
            <span class="m_w_c_des">
                <?=yii::t('weather', $current->weather[0]->id)?>
            </span>
        </div>
    </div>
    <div class="col-md-12 col-xs-12 py-10">
        <div class="m_c_more_decs">
            <div class="m_c_more_decs_item">
                <span class="m_c_morder_desc_title">
                    <?=yii::t('weather','Feels Like')?>
                </span>
                <span class="m_c_more_decs_item_val">
                    <b> <?=round($current->feels_like)?>&deg;</b>
                </span>
            </div>
            <div class="m_c_more_decs_item">
                <span class="m_c_morder_desc_title">
                    <?=yii::t('weather','Pressure')?>
                </span>
                <span class="m_c_more_decs_item_val">
                    <b><?=$current->pressure?></b>
                    <?=yii::t('weather','pressure_')?>
                </span>
            </div>
            <div class="m_c_more_decs_item">
                <span class="m_c_morder_desc_title">
                    <?=yii::t('weather','Humidity')?>
                </span>
                <span class="m_c_more_decs_item_val">
                    <b> <?=$current->humidity?> </b>%
                </span>
            </div>
            <div class="m_c_more_decs_item">
                <span class="m_c_morder_desc_title">
                    <?=yii::t('weather','Wind')?>
                </span>
                <span class="m_c_more_decs_item_val">
                    <i class="fa fa-location-arrow" style="transform:rotate(<?=-1*($current->wind_deg)?>deg)"></i>
                    <b><?=round($current->wind_speed)?></b>
                    <?=Yii::t('weather', 'wind_speed_')?>
                    <?=$weather->wDtoText($current->wind_deg,1)?>
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-12 py-10">
        <div class="m_part_of_day_weahter">

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
                    $icon = $weather->iconsInfo[$id].'n';
                } else {
                    $icon = $weather->iconsInfo[$id].'d';
                }

                ?>

                <div class="m_part_of_day">
                    <h5><?=yii::t('weather', $namePartTime) ?></h5>
                    <img src="/themes/turkmenportal/img/weatherIcon/<?=$icon?>.png" alt="">
                    <span> <b><?=round($weatherInfo->temp->$partTime)?></b>&deg;</span>
                </div>
            <?php
            endforeach;
            ?>
        </div>
    </div>
</div>


    <div class="row bg_color_grey py-10 hidden-md hidden-lg ">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <?php
            $i = 0;

            foreach ($daily as $item){
                $i++;
                if ($i == 8) break;
                $dToday = date('Y:m:d');
                if (date('Y:m:d',$item->dt) === $dToday) continue;

                $id  = $item->weather[0]->id;
                if (substr($item->weather[0]->icon,-1) === 'n'){
                    $icon = $weather->iconsInfo[$id].'n';
                } else {
                    $icon = $weather->iconsInfo[$id].'d';
                }

                $feels_likeMax = $item->feels_like->day;
                $feels_likeMin = $item->feels_like->day;

                foreach ($item->feels_like as $key => $fl){
                    if ($feels_likeMax < $fl) $feels_likeMax = $fl;
                    if ($feels_likeMin > $fl) $feels_likeMin = $fl;
                }


                ?>
                <div class=" my-10 mx-10">
                    <div class="px-10 py-5 m_daily_w bg_color_white" role="tab" id="head_<?=date('d', $item->dt)?>">
                        <div class="m_daily_w_p1">
                            <div class="m_daily_date">
                                <span><?=Yii::app()->controller->renderDateWeekDay3l($item->dt)?></span>
                                <span><?=date('n/j', $item->dt)?></span>
                            </div>
                            <img src="/themes/turkmenportal/img/weatherIcon/A6d.png" alt="">
                            <div class="m_daily_temp">
                                <?=round($item->temp->min)?>&deg; ... <?=round($item->temp->max)?>&deg;
                            </div>
                        </div>
                        <div class="m_daily_w_p2">
                            <i class="fa fa-tint" style="color: grey;padding-right: 4px"></i> <?=$item->humidity?>%
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?=date('d', $item->dt)?>" aria-expanded="true" aria-controls="collapse_<?=date('d', $item->dt)?>">
                                <i class="fa fa-arrow-down"></i>
                            </a>
                        </div>
                    </div>
                    <div id="collapse_<?=date('d', $item->dt)?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="head_<?=date('d', $item->dt)?>">
                        <div class="m_c_more_decs px-10 py-5 bg_color_white ">
                            <div class="m_c_d_more_decs_item">
                                <span class="">
                                    <?= yii::t('weather', 'Pressure') ?>
                                </span>
                                                <span class="">
                                    <b><?= $item->pressure ?></b>
                                                    <?= yii::t('weather', 'pressure_') ?>
                                </span>
                            </div>
                            <div class="m_c_d_more_decs_item">
                                <span class="">
                                    <?= yii::t('weather', 'Humidity') ?>
                                </span>
                                                <span class="">
                                    <b> <?= $item->humidity ?> </b>%
                                </span>
                            </div>
                            <div class="m_c_d_more_decs_item">
                                <span class="">
                                    <?= yii::t('weather', 'Wind') ?>
                                </span>
                                                <span class="">
                                    <i class="fa fa-location-arrow" style="transform:rotate(<?= -1 * ($current->wind_deg) ?>deg)"></i>
                                    <b><?= round($item->wind_speed) ?></b>
                                                    <?= Yii::t('weather', 'wind_speed_') ?>
                                                    <?= $weather->wDtoText($item->wind_deg, 1) ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>


                <?php

            }

            ?>
        </div>
    </div>
