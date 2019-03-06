<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');

            $table->string('title');
            $table->integer('route_id')->unsigned()->nullable();
            $table->integer('terminal_id')->unsigned();
            $table->text('number')->nullable();
            $table->integer('seats')->unsigned();
            $table->integer('foldings')->nullable();
            $table->integer('standees')->nullable();
            $table->integer('bus_type_id')->unsigned();
            $table->integer('luxury_type_id')->unsigned();
            $table->integer('driver_id')->unsigned()->nullable();
            $table->integer('conductor_id')->unsigned()->nullable();
            $table->string('refcode')->nullable();
            $table->boolean('status')->default(1);
            $table->integer('city_id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->integer('user_id')->unsigned();

            //$table->foreign('route_id')->references('id')->on('routes');
            $table->foreign('terminal_id')->references('id')->on('terminals');
            $table->foreign('luxury_type_id')->references('id')->on('luxury_types');
            $table->foreign('bus_type_id')->references('id')->on('bus_types');
            //$table->foreign('driver_id')->references('id')->on('staff');
            //$table->foreign('conductor_id')->references('id')->on('staff');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('buses');
    }
}
