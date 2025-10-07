<?php
namespace App\Http\forecastsAdminHelper;
class forecastsAdminHelper
{
    public static function getColorByTemperature($temperature)
    {
        return match (true) {
            $temperature <= 0 => 'Dodgerblue',
            $temperature >= 1 && $temperature <= 15 => 'blue',
            $temperature >= 16 && $temperature <= 25 => 'orange',
            default => 'red',
        };
    }



    public static function getWeatherIcon($weatherType)
    {
        $key = strtolower(trim($weatherType));

        return match ($key) {
            'sunny', 'sunny,' => '<i class="fa-solid fa-sun text-warning"></i>',
            'rainy' => '<i class="fa-solid fa-cloud-showers-heavy"></i>',
            'snowy' => '<i class="fa-solid fa-snowflake text-info"></i>',
            'cloudy' => '<i class="fa-solid fa-cloud text-info"></i>',
            default => '<i class="fa-solid fa-question-circle text-muted"></i>',
        };
    }

    public static function getAvailableWeatherTypes(): array
    {
        return ['sunny','sunny,', 'rainy', 'snowy','cloudy'];
    }
    public static function getWeatherIconFromApi(array $condition): string
    {
        // WeatherAPI returns icon URLs like: "//cdn.weatherapi.com/weather/64x64/day/302.png"
        // We'll prepend "https:" to make it a valid URL
        $iconUrl = 'https:' . $condition['icon'];

        // Return an <img> tag with the icon
        return '<img src="' . $iconUrl . '" alt="' . htmlspecialchars($condition['text']) . '" title="' . htmlspecialchars($condition['text']) . '" />';
    }
}
