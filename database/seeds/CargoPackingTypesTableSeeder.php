<?php

use Illuminate\Database\Seeder;

class CargoPackingTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cargo_packing_types')->insert([
            'title' => 'Box',
            'company_id' => 1,
            'user_id' => 1
        ]);
        DB::table('cargo_packing_types')->insert([
            'title' => 'Bag',
            'company_id' => 1,
            'user_id' => 1
        ]);
        DB::table('cargo_packing_types')->insert([
            'title' => 'Poly Bag',
            'company_id' => 1,
            'user_id' => 1
        ]);
        DB::table('cargo_packing_types')->insert([
            'title' => 'Tapped',
            'company_id' => 1,
            'user_id' => 1
        ]);
    }
}
