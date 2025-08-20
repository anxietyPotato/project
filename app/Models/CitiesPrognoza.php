<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ForecastModel;

class CitiesPrognoza extends Model
{
    protected $table = 'cities_prognoza';
    protected $fillable = ['name'];


    public function cities()
    {
        return $this->belongsTo(Cities::class, 'city_id');
    }
    public function getRouteKeyName()
    {
        return 'name';
    }
    public function forecast()
    {
        return $this->hasMany(ForecastModel::class, 'city_id', 'id');
    }
    public function latestForecast()
    {
        return $this->hasOne(ForecastModel::class, 'city_id', 'id')->latestOfMany();
    }

    public function getHumidityAttribute()
    {
        return $this->latestForecast->humidity ?? null;
    }



    public function forecasts()
    {
        return $this->hasMany(ForecastModel::class, 'city_id', 'id');
    }

}
