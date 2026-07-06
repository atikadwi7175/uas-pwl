<?php

namespace Database\Seeders;

use App\Models\Transaksi;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        // asumsi: user_id 2 = Kasir (dari UserSeeder)
        // asumsi: menu_id 1-5 = food, 6-10 = beverage (dari MenuSeeder)
        // data dibuat manual untuk rentang 2 minggu terakhir, 3-4 transaksi per minggu

        // Minggu ke-2 (13-14 hari lalu s/d 8 hari lalu)
        Transaksi::create([
            'menu_id' => 6, // Kopi Hitam
            'user_id' => 2,
            'jumlah' => 5,
            'total_harga' => 12000 * 5,
            'tanggal' => now()->subDays(13)->format('Y-m-d'),
        ]);

        Transaksi::create([
            'menu_id' => 8, // Cappuccino
            'user_id' => 2,
            'jumlah' => 3,
            'total_harga' => 20000 * 3,
            'tanggal' => now()->subDays(11)->format('Y-m-d'),
        ]);

        Transaksi::create([
            'menu_id' => 1, // Roti Bakar
            'user_id' => 2,
            'jumlah' => 4,
            'total_harga' => 15000 * 4,
            'tanggal' => now()->subDays(9)->format('Y-m-d'),
        ]);

        Transaksi::create([
            'menu_id' => 10, // Es Kopi Gula Aren
            'user_id' => 2,
            'jumlah' => 6,
            'total_harga' => 18000 * 6,
            'tanggal' => now()->subDays(8)->format('Y-m-d'),
        ]);

        // Minggu ke-1 (7 hari lalu s/d hari ini)
        Transaksi::create([
            'menu_id' => 9, // Latte
            'user_id' => 2,
            'jumlah' => 2,
            'total_harga' => 20000 * 2,
            'tanggal' => now()->subDays(6)->format('Y-m-d'),
        ]);

        Transaksi::create([
            'menu_id' => 6, // Kopi Hitam
            'user_id' => 2,
            'jumlah' => 7,
            'total_harga' => 12000 * 7,
            'tanggal' => now()->subDays(4)->format('Y-m-d'),
        ]);

        Transaksi::create([
            'menu_id' => 3, // Kentang Goreng
            'user_id' => 2,
            'jumlah' => 3,
            'total_harga' => 15000 * 3,
            'tanggal' => now()->subDays(2)->format('Y-m-d'),
        ]);
    }
}
