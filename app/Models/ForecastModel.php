<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForecastModel extends Model
{
    protected $table = 'forecast';

    protected $fillable = ['city_id', 'temperature','humidity','Forecast_date'];

    public function cityForecast()
    {
        return $this->belongsTo(CitiesPrognoza::class, 'city_id','id');
    }


}
