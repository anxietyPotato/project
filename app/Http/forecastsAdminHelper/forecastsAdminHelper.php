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
            'sunny' => '<i class="fa-solid fa-sun text-warning"></i>',
            'sunny,' => '<i class="fa-solid fa-sun text-warning"></i>',
            'rainy' => '<i class="fa-solid fa-cloud-rain text-primary"></i>',
            'snowy' => '<i class="fa-solid fa-snowflake text-info"></i>',
            'cloudy' => '<i class="fa-solid fa-cloud text-info"></i>',

        ];

        $key = strtolower(trim($weatherType));
        return $map[$key] ?? '<i class="fa-solid fa-question-circle text-muted"></i>';
    } //this can be done with constant CONST


    public static function getAvailableWeatherTypes(): array
    {
        return ['sunny','sunny,', 'rainy', 'snowy','cloudy'];
    }
}
