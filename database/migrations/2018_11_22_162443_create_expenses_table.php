<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');

            $table->float('amount')->unsigned();
            $table->integer('expense_type_id')->unsigned();
            $table->integer('schedule_id')->unsigned();
            $table->boolean('departure')->default(1);
            $table->boolean('status')->default(1);

            $table->integer('user_id')->unsigned();
            $table->integer('company_id')->unsigned();

            $table->foreign('expense_type_id')->references('id')->on('expense_types');
            $table->foreign('schedule_id')->references('id')->on('schedules');
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
        Schema::dropIfExists('expenses');
    }
}
