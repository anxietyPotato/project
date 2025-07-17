<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForecastModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forecast', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('city_id');
            $table->float('temperature');
            $table->date('forecast_date');
            $table->timestamps();

            $table->foreign('city_id')
                ->references('id')
                ->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forecast');
    }
}
