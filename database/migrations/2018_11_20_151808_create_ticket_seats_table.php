<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketSeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_seats', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->text('seat');
            $table->enum('gender', ['M', 'F']);
            $table->integer('ticket_id')->unsigned();
            //$table->enum('type', ['M', 'F']);
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
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
        Schema::dropIfExists('ticket_seats');
    }
}
