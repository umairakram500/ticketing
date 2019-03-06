<?php

use Illuminate\Database\Seeder;

class CargoGoodsTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cargo_goods_types')->insert([
            'title' => 'Mobile',
            'company_id' => 1,
            'user_id' => 1
        ]);
        DB::table('cargo_goods_types')->insert([
            'title' => 'Bottle',
            'company_id' => 1,
            'user_id' => 1
        ]);
        DB::table('cargo_goods_types')->insert([
            'title' => 'Cotton',
            'company_id' => 1,
            'user_id' => 1
        ]);
        DB::table('cargo_goods_types')->insert([
            'title' => 'Drink',
            'company_id' => 1,
            'user_id' => 1
        ]);
    }
}
