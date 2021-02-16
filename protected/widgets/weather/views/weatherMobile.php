<?php

$currentId  = $current->weather[0]->id;
if (substr($current->weather[0]->icon,-1) === 'n'){
    $icon = $weather->iconsInfo[$currentId].'n';
} else {
    $icon = $weather->iconsInfo[$currentId].'d';
}

?>
    <div class="weather_info_m">
        <a href="/weather">
                <div class="weather_info_icon">
                <img src="/themes/turkmenportal/img/weatherIcon/<?=$icon?>.png" alt="<?=$current->weather[0]->description?>" >
                <span class="weather_info_temp"><?=$current->temp?>&deg;</span>
            </div>
        </a>
    </div>
