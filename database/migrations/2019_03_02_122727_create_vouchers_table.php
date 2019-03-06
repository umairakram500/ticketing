<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');

            $table->string('vouchercode')->nullable();
            $table->integer('bus_id')->unsigned();
            $table->integer('route_id')->unsigned()->nullable();
            $table->integer('income')->unsigned();
            $table->integer('terminal_exps')->unsigned();
            $table->integer('route_exps')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->integer('terminal_id')->unsigned();

            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('vouchers');
    }
}
