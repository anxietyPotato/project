<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CitiesPrognoza extends Model
{
    protected $table = 'cities_prognoza';
    protected $fillable = ['name'];
}
