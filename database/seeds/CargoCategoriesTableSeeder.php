<?php

use Illuminate\Database\Seeder;

class CargoCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cargo_categories')->insert([
            'title' => 'Electronics',
            'company_id' => 1,
            'user_id' => 1
        ]);
        DB::table('cargo_categories')->insert([
            'title' => 'Wooden',
            'company_id' => 1,
            'user_id' => 1
        ]);
        DB::table('cargo_categories')->insert([
            'title' => 'Liquid',
            'company_id' => 1,
            'user_id' => 1
        ]);
        DB::table('cargo_categories')->insert([
            'title' => 'Glass',
            'company_id' => 1,
            'user_id' => 1
        ]);
        DB::table('cargo_categories')->insert([
            'title' => 'Paper',
            'company_id' => 1,
            'user_id' => 1
        ]);
    }
}
