<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transaction::factory(20)->create();

        for ($i=1; $i <= 10; $i++) { 
            Transaction::find($i)->update([
                'status' => 'selesai',
                'dibayar' => 'dibayar',
            ]);
        }
    }
}
