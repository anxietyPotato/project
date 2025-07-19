<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCityStatsTable extends Migration
{
    public function up()
    {
        Schema::create('city_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->constrained('cities')->onDelete('cascade');
            $table->decimal('temperature', 5, 2)->nullable();
            $table->decimal('humidity', 5, 2)->nullable();
            $table->timestamp('recorded_at')->nullable();

            $table->timestamps();
            $stats = CityStats::with('city')->get();
        });
    }

    public function down()
    {
        Schema::dropIfExists('city_stats');
    }
}
