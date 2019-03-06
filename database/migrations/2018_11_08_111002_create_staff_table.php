<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');

            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('cnic', 15);
            $table->date('cnic_expiry');
            $table->string('licences', 10)->nullable();
            $table->date('licences_expiry')->nullable();
            $table->date('images')->nullable();
            $table->integer('city_id')->unsigned();
            $table->integer('staff_type_id')->unsigned();
            $table->integer('terminal_id')->unsigned();
            $table->boolean('status')->default(1);
            $table->integer('user_id')->unsigned();
            $table->integer('company_id')->unsigned();

            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('terminal_id')->references('id')->on('terminals');
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
        Schema::dropIfExists('staff');
    }
}
