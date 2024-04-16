<?php

namespace Database\Seeders;

use App\Models\Outlet;
use Illuminate\Database\Seeder;

class OutletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Outlet::create([
            'nama' => 'Outlet Laundry Ku',
            'alamat' => 'Jalan Raya Nomor 7, Metro',
            'tlp' => '08987654321',
        ]);
    }
}
