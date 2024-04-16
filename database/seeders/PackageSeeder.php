<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Package::create([
            'id_outlet' => 1,
            'jenis' => 'kiloan',
            'nama_paket' => 'Cuci baju dewasa',
            'harga' => 6000,
        ]);

        Package::create([
            'id_outlet' => 1,
            'jenis' => 'kiloan',
            'nama_paket' => 'Cuci baju anak',
            'harga' => 4000,
        ]);

        Package::create([
            'id_outlet' => 1,
            'jenis' => 'selimut',
            'nama_paket' => 'Cuci selimut',
            'harga' => 10000,
        ]);

        Package::create([
            'id_outlet' => 1,
            'jenis' => 'bed_cover',
            'nama_paket' => 'Cuci bed cover',
            'harga' => 15000,
        ]);

        Package::create([
            'id_outlet' => 1,
            'jenis' => 'kaos',
            'nama_paket' => 'Cuci kaos olahraga',
            'harga' => 8000,
        ]);
    }
}
