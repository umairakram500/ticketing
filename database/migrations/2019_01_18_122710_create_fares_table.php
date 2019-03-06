<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_fares', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');

            $table->integer('route_id')->unsigned();
            $table->integer('luxury_id')->unsigned();
            $table->integer('from_terminal_id')->unsigned();
            $table->integer('to_terminal_id')->unsigned();
            $table->float('fare')->nullable();
            $table->float('kms')->nullable();
            $table->integer('company_id')->unsigned()->default(1);

            $table->foreign('route_id')->references('id')->on('routes');
            $table->foreign('luxury_id')->references('id')->on('luxury_types');
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
        Schema::dropIfExists('fares');
    }
}
