<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCitiesModel extends Model
{
    protected $table = 'user_cities';
    protected $fillable = ['user_id', 'city_id'];
}
