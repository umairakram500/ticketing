<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');

            $table->text('p_name')->nullable()->comment('Passenger Name');
            $table->text('p_phone')->nullable();
            $table->text('p_cnic')->nullable();
            $table->integer('customer_id')->nullable()->unsigned();
            $table->integer('total_seats');
            $table->text('seat_numbers')->nullable();
            $table->integer('fare')->default(1);
            $table->integer('total_fare');
            $table->integer('discount')->nullable();
            $table->integer('refund')->nullable();
            $table->integer('ticket_no')->nullable();
            $table->string('voucher_no', 20)->nullable();
            $table->text('remarks')->nullable();

            $table->integer('from_stop')->nullable();
            $table->integer('to_stop')->nullable();
            // forgien keies fields
            $table->integer('from_city_id')->unsigned();
            $table->integer('to_city_id')->unsigned();
            $table->integer('schedule_id')->unsigned();
            $table->integer('route_id')->unsigned();
            $table->integer('terminal_id')->unsigned()->nullable();
            $table->integer('bus_id')->unsigned()->nullable();
            $table->integer('company_id')->unsigned()->default(1);
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('btype_id')->unsigned()->default(1);
            // Status
            $table->boolean('status')->default(1);
            $table->boolean('departure')->default(0);
            $table->boolean('paid')->default(0);
            $table->integer('from_sort')->nullable();
            $table->integer('to_sort')->nullable();
            // forgien keies
            $table->foreign('from_city_id')->references('id')->on('cities');
            $table->foreign('to_city_id')->references('id')->on('cities');
            $table->foreign('schedule_id')->references('id')->on('schedules');
            $table->foreign('route_id')->references('id')->on('routes');
            $table->foreign('terminal_id')->references('id')->on('terminals');
            //$table->foreign('bus_id')->references('id')->on('buses');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('btype_id')->references('id')->on('booking_types');

            $table->dateTime('booking_for')->unsigned()->default(1);
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
        Schema::dropIfExists('tickets');
    }
}
