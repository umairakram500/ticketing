<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');

            $table->string('title');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->integer('city_id')->unsigned()->default(0);
            $table->string('logo')->nullable();
            $table->boolean('status')->default(1);
            $table->integer('user_id')->unsigned();
            $table->integer('owner_id')->unsigned();

            //$table->foreign('user_id')->references('id')->on('users');
            //$table->foreign('owner_id')->references('id')->on('users');

            $table->timestamps();
            $table->softDeletes();
        });

        /*Schema::table('users', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('companies');
        });*/

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
