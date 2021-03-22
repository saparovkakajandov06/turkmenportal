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
//
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
                <?=$current->weather[0]->description?>
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
                    <?=Yii::app()->controller->wDtoText($current->wind_deg,1)?>
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
                    $icon = $iconsInfo[$id].'n';
                } else {
                    $icon = $iconsInfo[$id].'d';
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


<div class="row bg_color_grey py-10 ">
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


        <div class="col-md-12 py-5 bg_color_white my-10">
            <div class="m_daily_w">
                <div class="m_daily_w_p1">
                    <div class="m_daily_date">
                        <span><?=Yii::app()->controller->renderDateWeekDay3l($item->dt)?></span>
                        <span><?=date('n/j', $item->dt)?></span>
                    </div>
                    <img src="/themes/turkmenportal/img/weatherIcon/A6d.png" alt="">
                    <div class="m_daily_temp">
                        <?=round($item->temp->min)?>&deg;/<?=round($item->temp->max)?>&deg;
                    </div>
                </div>
                <div class="m_daily_w_p2">
                    <i class="fa fa-tint" style="color: grey;padding-right: 4px"></i> <?=$item->humidity?>%
                </div>
            </div>
        </div>
        <?php

    }

    ?>
</div>




<!--  test mobile version-->

<div class="row bg_color_grey py-10 hidden-md hidden-lg ">
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


        <div class="col-md-12 py-5 bg_color_white my-10">
            <div class="m_daily_w">
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
                </div>
            </div>
        </div>
        <?php

    }

    ?>
</div>
