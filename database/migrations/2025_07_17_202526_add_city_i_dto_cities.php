<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCityIDtoCities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     schema::table('cities', function (Blueprint $table) {
         $table->dropColumn('name');

         $table->unsignedBigInteger('city_id');

         $table->foreign('city_id')->references('id')->on('cities');
     });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::table('cities', function (Blueprint $table) {});
    }
}
