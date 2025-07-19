<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forecast extends Model




{
    protected $fillable = [
        'city_id',
        'temperature',
        'forecast_date',
    ];

    public function city()
    {
        return $this->belongsTo(Cities::class);
    }

}
