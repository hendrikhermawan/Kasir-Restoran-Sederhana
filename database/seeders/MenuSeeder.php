<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
    \App\Models\Menu::create([
        'nama' => 'Nasi Goreng',
        'harga' => 25000,
        'gambar' => 'https://via.placeholder.com/150',
    ]);

    \App\Models\Menu::create([
        'nama' => 'Mie Ayam',
        'harga' => 20000,
        'gambar' => 'https://via.placeholder.com/150',
    ]);
    }

}
