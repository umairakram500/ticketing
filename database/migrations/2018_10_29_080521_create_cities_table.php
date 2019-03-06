<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('name');
            $table->boolean('status')->default(1);
            $table->text('remarks')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('company_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('company_id')->references('id')->on('companies');

            $table->timestamps();
            $table->softDeletes();
        });
        /*Schema::table('users', function (Blueprint $table) {
            $table->foreign('city_id')->references('id')->on('cities');
        });
        Schema::table('companies', function (Blueprint $table) {
            $table->foreign('city_id')->references('id')->on('cities');
        });*/


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}

