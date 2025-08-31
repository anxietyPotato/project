<?php
namespace App\Http\forecastsAdminHelper;
class forecastsAdminHelper
{
    public static function getColorByTemperature($temperature){


        if ($temperature <= 0) {
            $color = 'Dodgerblue';
        } elseif ($temperature >= 1 && $temperature<= 15 ) {
            $color = 'blue'; // or whatever color you want for warmer temps
        }
        elseif ($temperature >= 15 && $temperature <=  25){
            $color= 'orange';
        }
        else {
            $color = 'red' ;
        }
        return $color;
    }


    public static function getWeatherIcon($weatherType)
    {
        $map = [
            'sunny' => 'fa-solid fa-sun text-warning',
            'sunny,' => 'fa-solid fa-sun text-warning',
            'rainy' => 'fa-solid fa-cloud-rain text-primary',
            'snowy' => 'fa-solid fa-snowflake text-info',
        ];

        $key = strtolower(trim($weatherType));
        return $map[$key] ?? 'fa-solid fa-question-circle text-muted';
    }




}
