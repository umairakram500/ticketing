<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->text('title')->nullable();
            $table->integer('from_city_id')->unsigned();
            $table->integer('from_terminal_id')->unsigned()->default(0);
            $table->integer('to_city_id')->unsigned();
            $table->integer('to_terminal_id')->unsigned()->default(0);
            $table->string('travel_time', 20)->nullable();
            $table->float('fare', 8, 2)->nullable()->unsigned();
            $table->text('stations')->nullable();
            $table->integer('kms')->nullable()->unsigned();
            $table->integer('diesel')->nullable()->unsigned();
            $table->boolean('status')->default(1);
            $table->text('remarks')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('company_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('from_city_id')->references('id')->on('cities');
            $table->foreign('to_city_id')->references('id')->on('cities');
            $table->foreign('from_terminal_id')->references('id')->on('terminals');
            $table->foreign('to_terminal_id')->references('id')->on('terminals');
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
        Schema::dropIfExists('routes');
    }
}
