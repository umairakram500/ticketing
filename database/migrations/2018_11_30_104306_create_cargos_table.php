<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargos', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            // Sender
            $table->text('s_name');
            $table->text('s_email')->nullable();
            $table->text('s_phone')->nullable();
            $table->text('s_cnic')->nullable();
            $table->text('s_address')->nullable();
            $table->integer('s_city')->unsigned();
            $table->integer('s_terminal')->unsigned();
            // Receiver
            $table->text('r_name');
            $table->text('r_email')->nullable();
            $table->text('r_phone')->nullable();
            $table->text('r_cnic')->nullable();
            $table->text('r_address')->nullable();
            $table->integer('r_city')->unsigned();
            $table->integer('r_terminal')->unsigned();

            $table->float('weight')->unsigned();
            $table->float('qty')->unsigned();
            $table->float('charges')->unsigned();
            $table->integer('shipment_status_id')->unsigned();
            $table->integer('schedule_id')->unsigned()->default(0);
            $table->boolean('status')->default(1);
            $table->integer('user_id')->unsigned();
            $table->integer('company_id')->unsigned();

            $table->foreign('s_city')->references('id')->on('cities');
            $table->foreign('s_terminal')->references('id')->on('cities');
            $table->foreign('r_city')->references('id')->on('cities');
            $table->foreign('r_terminal')->references('id')->on('cities');
            $table->foreign('shipment_status_id')->references('id')->on('shipment_status');
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
        Schema::dropIfExists('cargos');
    }
}
