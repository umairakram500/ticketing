<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            'name' => 'Lahore',
            'user_id' => 1,
            'company_id' => 1
        ]);
        DB::table('cities')->insert([
            'name' => 'Faisalabad',
            'user_id' => 1,
            'company_id' => 1
        ]);
        DB::table('cities')->insert([
            'name' => 'Gujranwal',
            'user_id' => 1,
            'company_id' => 1
        ]);
    }
}
