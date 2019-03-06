<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');

            $table->integer('route_id')->unsigned();
            $table->integer('luxury_type')->comment('Luxury Type id')->unsigned();
            $table->tinyInteger('type')->comment('Permanent, range, specific date, drop');
            $table->time('depart_time')->nullable();
            $table->time('arrival_time')->nullable();
            $table->dateTime('from_date')->nullable();
            $table->dateTime('to_date')->nullable();
            $table->string('notes', 191)->nullable();
            $table->integer('city_id')->unsigned()->nullable();
            $table->boolean('reverse')->default(0);
            $table->boolean('status')->default(1);

            $table->integer('user_id')->unsigned();
            $table->integer('company_id')->unsigned();

            $table->foreign('route_id')->references('id')->on('routes');
            $table->foreign('luxury_type')->references('id')->on('luxury_types');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('company_id')->references('id')->on('companies');

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
        Schema::dropIfExists('schedules');
    }
}
