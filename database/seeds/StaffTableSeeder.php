<?php

use Illuminate\Database\Seeder;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i<=5; $i++)
        DB::table('staff')->insert([
            'name' => 'Driver '.$i,
            'staff_type_id' => 1,
            'terminal_id' => 1,
            'city_id' => 1,
            'user_id' => 1,
            'company_id' => 1
        ]);

        for ($i=1; $i<=5; $i++)
            DB::table('staff')->insert([
                'name' => 'Conductor '.$i,
                'staff_type_id' => 2,
                'terminal_id' => 1,
                'city_id' => 1,
                'user_id' => 1,
                'company_id' => 1
            ]);
    }
}
