<?php

use Illuminate\Database\Seeder;

class LuxuryTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('luxury_types')->insert([
            'title' => 'Luxury',
            'user_id' => 1,
            'company_id' => 1
        ]);
        DB::table('luxury_types')->insert([
            'title' => 'Super Luxury',
            'user_id' => 1,
            'company_id' => 1
        ]);
    }
}
