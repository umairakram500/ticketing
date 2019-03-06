<?php

use Illuminate\Database\Seeder;

class RoutesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('routes')->insert([
            'title' => 'Faisalabad - Lahore',
            'from_city_id' => 1,
            'from_terminal_id' => 1,
            'to_city_id' => 2,
            'to_terminal_id' => 2,
            'travel_time' =>'1:30',
            'fare' => 450,
            'user_id' => 1,
            'company_id' => 1
        ]);

        DB::table('routes')->insert([
            'title' => 'Faisalabad - Gujranwala',
            'from_city_id' => 1,
            'from_terminal_id' => 1,
            'to_city_id' => 3,
            'to_terminal_id' => 3,
            'travel_time' =>'1:30',
            'fare' => 450,
            'user_id' => 1,
            'company_id' => 1
        ]);

        DB::table('routes')->insert([
            'title' => 'Lahore - Gujranwala',
            'from_city_id' => 2,
            'from_terminal_id' => 3,
            'to_city_id' => 3,
            'to_terminal_id' => 2,
            'travel_time' =>'1:30',
            'fare' => 450,
            'user_id' => 1,
            'company_id' => 1
        ]);

        Schema::enableForeignKeyConstraints();

        

    }
}
