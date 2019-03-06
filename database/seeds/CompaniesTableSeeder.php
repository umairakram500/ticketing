<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();


        DB::table('companies')->insert([
            'title' => "Comapany 1",
            'user_id' => 1,
            'owner_id' => 2
        ]);


        Schema::enableForeignKeyConstraints();
    }
}
