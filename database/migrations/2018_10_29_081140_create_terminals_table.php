<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTerminalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terminals', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('title');
            $table->integer('terminal_type');
            $table->integer('city_id')->unsigned();
            $table->string('address', 255)->nullable();
            $table->string('lat', 25)->nullable();
            $table->string('lng', 25)->nullable();
            $table->string('refcode')->nullable();
            $table->boolean('status')->default(1);
            $table->integer('user_id')->unsigned();
            $table->integer('company_id')->unsigned();

            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('company_id')->references('id')->on('companies');

            $table->timestamps();
            $table->softDeletes();
        });

        /*Schema::table('users', function (Blueprint $table) {
            $table->foreign('terminal_id')->references('id')->on('terminals');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('terminals');
    }
}
