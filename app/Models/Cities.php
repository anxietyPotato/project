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
        return $this->hasOne(CitiesPrognoza::class, 'id', 'id');
        // hasOne(RelatedModel::class, foreign_key_on_related_table, local_key_on_this_table)
    }

    public function getHumidityAttribute()
    {
        return $this->cityPrognoza->humidity ?? null;

    }





    // 👇 this makes route model binding use "name" instead of "id"
}

