<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForeacastController extends Controller
{
    public function Index($city

    )
    {
       $foreacasts = [
           "beograd" => [22,35,25,24,18],
            "sarajevo" => [33,34,35,36,37],

       ];
       $city = strtolower($city);

       if (!array_key_exists($city, $foreacasts)) {

           die("this city doesn't exist");
       }
      }


}
