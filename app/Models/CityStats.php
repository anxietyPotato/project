<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;




class CityStats extends Model
{
    protected $fillable = [
        'city_id', 'temperature', 'humidity', 'recorded_at',
    ];

    public function city()
    {
        return $this->belongsTo(Cities::class);
    }

}
