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
<h1>По техническим причинам раздел не работает приносим свои извинения</h1>