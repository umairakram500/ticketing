<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boardings', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('route_id');
            $table->integer('schedule_id');
            $table->string('from_city')->nullable();
            $table->string('to_city')->nullable();
            $table->string('from_terminal');
            $table->string('to_terminal');
            //$table->string('date');
            $table->string('driver_id');
            $table->string('conductor_id');
            $table->string('bus_id');
            $table->integer('total_passenger');
            $table->integer('total_fare');
            $table->integer('total_exp');
            $table->integer('total_discount')->nullable();
            $table->integer('total_refund')->nullable();
            $table->integer('netcash');
            $table->integer('voucher_id');
            $table->integer('en_psgs');
            $table->integer('en_income');
            $table->integer('cargo');
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boardings');
    }
}
