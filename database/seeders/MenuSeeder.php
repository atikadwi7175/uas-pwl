<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // Food
        Menu::create(['nama' => 'Roti Bakar', 'kategori' => 'food', 'deskripsi' => 'Roti bakar coklat keju', 'harga' => 15000]);
        Menu::create(['nama' => 'Pisang Goreng', 'kategori' => 'food', 'deskripsi' => 'Pisang goreng crispy, 5 pcs', 'harga' => 12000]);
        Menu::create(['nama' => 'Kentang Goreng', 'kategori' => 'food', 'deskripsi' => 'French fries porsi sedang', 'harga' => 15000]);
        Menu::create(['nama' => 'Croissant', 'kategori' => 'food', 'deskripsi' => 'Croissant butter panggang', 'harga' => 18000]);
        Menu::create(['nama' => 'Sandwich Panggang', 'kategori' => 'food', 'deskripsi' => 'Sandwich isi telur & sosis', 'harga' => 20000]);

        // Beverage
        Menu::create(['nama' => 'Kopi Hitam', 'kategori' => 'beverage', 'deskripsi' => 'Kopi hitam tubruk khas', 'harga' => 12000]);
        Menu::create(['nama' => 'Kopi Susu', 'kategori' => 'beverage', 'deskripsi' => 'Kopi susu gula aren', 'harga' => 15000]);
        Menu::create(['nama' => 'Cappuccino', 'kategori' => 'beverage', 'deskripsi' => 'Espresso dengan foam susu', 'harga' => 20000]);
        Menu::create(['nama' => 'Latte', 'kategori' => 'beverage', 'deskripsi' => 'Espresso dengan susu creamy', 'harga' => 20000]);
        Menu::create(['nama' => 'Es Kopi Gula Aren', 'kategori' => 'beverage', 'deskripsi' => 'Es kopi susu gula aren dingin', 'harga' => 18000]);
    }
}
