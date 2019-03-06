<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRouteExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_expenses', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');

            $table->integer('voucher_id')->unsigned();
            $table->integer('bus_id')->unsigned();
            $table->integer('route_id')->unsigned()->nullable();
            $table->integer('exptype_id')->unsigned();
            $table->integer('amount')->unsigned();

            $table->foreign('voucher_id')->references('id')->on('vouchers')->onDelete('cascade');
            $table->foreign('bus_id')->references('id')->on('buses');
            $table->foreign('exptype_id')->references('id')->on('expense_types');

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
        Schema::dropIfExists('route_expenses');
    }
}
