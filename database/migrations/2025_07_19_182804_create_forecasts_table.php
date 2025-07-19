<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


    /**
     * Run the migrations.
     *
     * @return void
     */

class CreateForecastsTable extends Migration
{
    public function up()
    {
        Schema::create('forecasts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->constrained('cities')->onDelete('cascade');
            $table->decimal('temperature', 5, 2);
            $table->date('forecast_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('forecasts');
    }
}
