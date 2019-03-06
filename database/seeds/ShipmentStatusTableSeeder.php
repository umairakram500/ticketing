<?php

use Illuminate\Database\Seeder;

class ShipmentStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shipment_status')->insert([
            'title' => 'Collected on Terminal',
            'company_id' => 1,
            'user_id' => 1
        ]);
        DB::table('shipment_status')->insert([
            'title' => 'Scheduled',
            'company_id' => 1,
            'user_id' => 1
        ]);
        DB::table('shipment_status')->insert([
            'title' => 'Departures',
            'company_id' => 1,
            'user_id' => 1
        ]);
        DB::table('shipment_status')->insert([
            'title' => 'Recivied on Terminal',
            'company_id' => 1,
            'user_id' => 1
        ]);
        DB::table('shipment_status')->insert([
            'title' => 'Delivered to Customer',
            'company_id' => 1,
            'user_id' => 1
        ]);
    }
}
