<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    use HasFactory;

    protected $table = "cities";
    protected $fillable = ["name", "temperature", "humidity"];


    public function cityPrognoza()
    {
        return $this->belongsTo(CitiesPrognoza::class, 'city_id');
    }
}
