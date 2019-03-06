<?php

use Illuminate\Database\Seeder;

class BusTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('bus_types')->insert([
            'title' => 'Company Bus',
            'user_id' => 1,
            'company_id' => 1
        ]);
        DB::table('bus_types')->insert([
            'title' => 'Regular Registered',
            'user_id' => 1,
            'company_id' => 1
        ]);
        DB::table('bus_types')->insert([
            'title' => 'Some Timer',
            'user_id' => 1,
            'company_id' => 1
        ]);
    }
}
