<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama' => 'PT.INO',
            'alamat' => 'Jl.Pemuda Kuningan',
            'email' => 'fikryramadhan572@gmail.com',
            'deskripsi' => 'Kuyyyyy Masseh',
            'role' => 'Merchant',
            'password' => bcrypt('fikry')
        ]);
        User::create([
            'nama' => 'PT.Kuyy',
            'alamat' => 'Jl.Pemuda Kuningan',
            'email' => 'kyy572@gmail.com',
            'deskripsi' => 'Kuyyyyy Masseh',
            'role' => 'Customer',
            'password' => bcrypt('fikry')
        ]);

        Menu::create([
            'nama' => 'Menu Spesial',
            'id_user' => 1,
            'image' => 'nksncksnc',
            'harga' => 23000,
            'deskripsi' => 'yahoo'
        ]);

        Menu::create([
            'nama' => 'Menu Gokill',
            'id_user' => 1,
            'image' => 'nksncksnc',
            'harga' => 23000,
            'deskripsi' => 'yahoo'
        ]);

    }
}
