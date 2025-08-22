<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWeatherTypeAndProbabilityToForecast extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forecast', function (Blueprint $table) {
            $table->String('weather_type')->default('Sunny');
            $table->unsignedSmallInteger('probability')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('forecast', function (Blueprint $table) {
            //
        });
    }
}
