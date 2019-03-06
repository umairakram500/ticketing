<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleStopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_stops', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('schedule_id')->unsigned();
            $table->integer('terminal_id')->unsigned();
            $table->integer('route_id')->unsigned();
            $table->time('depart')->nullable();
            $table->time('arrive')->nullable();
            $table->integer('company_id')->default(1);
            $table->foreign('route_id')->references('id')->on('routes');
            $table->foreign('terminal_id')->references('id')->on('terminals');
            $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule_stops');
    }
}
