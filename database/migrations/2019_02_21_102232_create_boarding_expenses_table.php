<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardingExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boarding_expenses', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');

            $table->integer('boarding_id')->unsigned();
            $table->integer('expense_type_id')->unsigned();
            $table->integer('amount')->unsigned();

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
        Schema::dropIfExists('boarding_expenses');
    }
}
