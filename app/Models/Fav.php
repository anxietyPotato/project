<?php

namespace App\Models;

class Fav
{
    public function city()
    {
        return $this->belongsTo(CitiesPrognoza::class, 'city_id', 'id');
    }
}
