<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensetypesTerminalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expensetypes_terminals', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('expensetype_id')->unsigned();
            $table->integer('terminal_id')->unsigned();
            $table->integer('amount')->unsigned();
            $table->foreign('expensetype_id')->references('id')->on('expense_types')->onDelete('cascade');
            $table->foreign('terminal_id')->references('id')->on('terminals')->onDelete('cascade');
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
        Schema::dropIfExists('expensetypes_terminals');
    }
}
