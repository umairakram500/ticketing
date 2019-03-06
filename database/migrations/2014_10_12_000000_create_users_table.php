<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('cnic')->nullable();
            $table->integer('dept_id')->unsigned()->nullable();
            $table->integer('design_id')->unsigned()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->integer('city_id')->unsigned()->nullable();
            $table->integer('terminal_id')->unsigned()->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->boolean('isadmin')->default(0);
            $table->integer('role_id')->unsigned()->nullable();
            $table->string('avatar', 255)->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
