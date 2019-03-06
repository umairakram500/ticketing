<?php

use Illuminate\Database\Seeder;

class TerminalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('terminals')->insert([
            'title' => 'Terminal 1',
            'city_id' => 1,
            'user_id' => 1,
            'company_id' => 1
        ]);
        DB::table('terminals')->insert([
            'title' => 'Terminal 2',
            'city_id' => 2,
            'user_id' => 1,
            'company_id' => 1
        ]);
        DB::table('terminals')->insert([
            'title' => 'Terminal 1',
            'city_id' => 1,
            'user_id' => 1,
            'company_id' => 1
        ]);


       
    }
}
