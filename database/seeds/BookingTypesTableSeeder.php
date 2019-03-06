<?php

use Illuminate\Database\Seeder;

class BookingTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('booking_types')->insert([
            'title' => 'Website',
            'icon' => 'globe',
            'user_id' => 1,
            'company_id' => 1
        ]);
        DB::table('booking_types')->insert([
            'title' => 'Terminal',
            'icon' => 'user',
            'user_id' => 1,
            'company_id' => 1
        ]);
        DB::table('booking_types')->insert([
            'title' => 'Android App',
            'icon' => 'android',
            'user_id' => 1,
            'company_id' => 1
        ]);
        DB::table('booking_types')->insert([
            'title' => 'IOS App',
            'icon' => 'apple',
            'user_id' => 1,
            'company_id' => 1
        ]);
        DB::table('booking_types')->insert([
            'title' => 'Phone Booking',
            'icon' => 'phone',
            'user_id' => 1,
            'company_id' => 1
        ]);
        DB::table('booking_types')->insert([
            'title' => 'Between Travel',
            'icon' => 'road',
            'user_id' => 1,
            'company_id' => 1
        ]);
    }
}
