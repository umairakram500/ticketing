<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionTableSeeder::class,
            RoleTableSeeder::class,
            UsersTableSeeder::class,
            CompaniesTableSeeder::class,
            //CitiesTableSeeder::class,
            //TerminalTableSeeder::class,
            //RoutesTableSeeder::class,
            //LuxuryTypesTableSeeder::class,
            BusTypesTableSeeder::class,
            StaffTypesTableSeeder::class,
            //StaffTableSeeder::class,
            //BusesTableSeeder::class,
            //ExpenseTypesTableSeeder::class,
            //CargoCategoriesTableSeeder::class,
            //CargoGoodsTypesTableSeeder::class,
            //CargoPackingTypesTableSeeder::class,
            //ShipmentStatusTableSeeder::class,
            BookingTypesTableSeeder::class
        ]);
    }
}
