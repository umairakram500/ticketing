<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRouteStopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_stops', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');

            $table->integer('route_id')->unsigned();
            $table->integer('terminal_id')->unsigned();
            $table->integer('sort_order')->unsigned();

            $table->integer('company_id')->unsigned();
            $table->foreign('route_id')->references('id')->on('routes')->onDelete('cascade');
            $table->foreign('terminal_id')->references('id')->on('terminals');
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
        Schema::dropIfExists('route_stops');
    }
}
