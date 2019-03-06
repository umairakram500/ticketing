<?php

use Illuminate\Database\Seeder;

class ExpenseTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $expense_types = array(
            'Commission Staff',
            'Diesel',
            'Lubricant',
            'Oil Filter',
            'Repairing',
            'Toll Tax',
            'Adda Commission',
            'Gun Man',
            'Foreman',
            'Other'
        );
        foreach($expense_types as $expense_type){
            DB::table('expense_types')->insert([
                'title' => $expense_type,
                'user_id' => 1,
                'company_id' => 1
            ]);
        }

    }
}
