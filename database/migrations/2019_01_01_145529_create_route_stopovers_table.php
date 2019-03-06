<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRouteStopoversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_stopovers', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');

            $table->integer('from_stop_id')->unsigned();
            $table->integer('to_stop_id')->unsigned();
            $table->float('fare')->unsigned()->nullable();
            $table->float('kms')->unsigned()->nullable();
            $table->time('travel_time')->nullable();
            $table->integer('route_id')->unsigned();
            $table->integer('company_id')->unsigned();

            $table->foreign('route_id')->references('id')->on('routes')->onDelete('cascade');
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
        Schema::dropIfExists('route_stopovers');
    }
}
