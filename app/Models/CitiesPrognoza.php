<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ForecastModel;


class CitiesPrognoza extends Model
{


    use HasFactory;


    protected $table = 'cities_prognoza';

    protected $fillable = ['name'];

    /**
     * A city can have many forecasts.
     */
    public function forecasts()
    {
        return $this->hasMany(ForecastModel::class, 'city_id', 'id')->orderby('forecast_date');
    }

    /**
     * Latest forecast for this city.
     */
    public function latestForecast()
    {
        return $this->hasOne(ForecastModel::class, 'city_id', 'id')->latestOfMany();
    }

    /**
     * Shortcut accessor: get humidity from latest forecast.
     */
    public function getHumidityAttribute()
    {
        return $this->latestForecast->humidity ?? null;
    }

// In CitiesPrognoza.php
    public function oneForecast()
    {
        return $this->hasOne(ForecastModel::class, 'city_id', 'id')
            ->whereDate('Forecast_date', Carbon::now()->format('Y-m-d'));
    }
    // App\Models\CitiesPrognoza.php
    public function getRouteKeyName()
    {
        return 'name';
    }

}
