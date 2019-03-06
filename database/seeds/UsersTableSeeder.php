<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Roles\Role;
use App\Models\Roles\Permission;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Schema::disableForeignKeyConstraints();
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345'),
            'terminal_id' => 0,
            'company_id' => 0,
            'city_id' => 0,
        ]);
        DB::table('users')->insert([
            'name' => 'User 1',
            'email' => 'user1@gmail.com',
            'password' => bcrypt('12345'),
            'terminal_id' => 1,
            'company_id' => 1,
            'city_id' => 1,
        ]);
        Schema::enableForeignKeyConstraints();*/

        DB::table('users')->insert([
            'name' => 'User new',
            'email' => 'usern@gmail.com',
            'password' => bcrypt('12345'),
            'terminal_id' => 1,
            'company_id' => 1,
            'city_id' => 1,
        ]);

    }
}
