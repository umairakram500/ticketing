<?php

use Illuminate\Database\Seeder;

class StaffTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staff_types')->insert([
            'title' => 'Driver',
            'user_id' => 1,
            'company_id' => 1
        ]);
        DB::table('staff_types')->insert([
            'title' => 'Conductor',
            'user_id' => 1,
            'company_id' => 1
        ]);
    }
}
