<?php

use Illuminate\Database\Seeder;

class BusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $c = 1;
        for($i=1; $i<=5; $i++){
            DB::table('buses')->insert([
                'title' => 'Bus '.$c++,
                'route_id' => 1,
                'number' => rand(1000, 9999),
                'seats' => rand(20, 60),
                'user_id' => 1,
                'terminal_id' => 1,
                'driver_id' => $i,
                'conductor_id' => $i+5,
                'company_id' =>  1,
                'bus_type_id' => rand(1,3),
                'luxury_type_id' => rand(1,2),
                'city_id' =>  1,
            ]);
        }
        for($i=1; $i<=5; $i++){
            DB::table('buses')->insert([
                'title' => 'Bus '.$c++,
                'route_id' => 1,
                'number' => rand(1000, 9999),
                'seats' => rand(20, 60),
                'user_id' => 1,
                'terminal_id' => 1,
                'driver_id' => $i,
                'conductor_id' => $i+5,
                'company_id' =>  1,
                'bus_type_id' => rand(1,3),
                'luxury_type_id' => rand(1,2),
                'city_id' =>  1,
            ]);
        }
    }
}
