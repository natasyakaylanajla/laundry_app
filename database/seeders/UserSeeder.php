<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'role' => 'admin',
            'id_outlet' => 1,
        ]);

        User::create([
            'nama' => 'Kasir',
            'username' => 'kasir',
            'password' => Hash::make('kasir'),
            'role' => 'kasir',
            'id_outlet' => 1,
        ]);

        User::create([
            'nama' => 'Owner',
            'username' => 'owner',
            'password' => Hash::make('owner'),
            'role' => 'owner',
            'id_outlet' => 1,
        ]);
    }
}
