<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargoItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargo_items', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');

            $table->integer('cargo_id')->unsigned();
            $table->text('barcode')->nullable();
            $table->integer('category_id')->unsigned();
            $table->integer('goods_type_id')->unsigned();
            $table->integer('packing_type_id')->unsigned();
            $table->integer('qty')->unsigned();
            $table->float('weight', 8,2)->unsigned();
            $table->text('remarks')->nullable();

            $table->integer('user_id')->unsigned();
            $table->integer('company_id')->unsigned();

            $table->foreign('cargo_id')->references('id')->on('cargos');
            $table->foreign('category_id')->references('id')->on('cargo_categories');
            $table->foreign('goods_type_id')->references('id')->on('cargo_goods_types');
            $table->foreign('packing_type_id')->references('id')->on('cargo_packing_types');
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
        Schema::dropIfExists('cargo_items');
    }
}
