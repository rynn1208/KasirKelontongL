<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $barangs = [
            // Kategori: Sembako & Kebutuhan Pokok
            ['nama_barang' => 'Beras Rojolele 5kg', 'kategori' => 'Sembako', 'harga' => 75000, 'stok' => 20, 'diskon_persen' => 0],
            ['nama_barang' => 'Minyak Goreng Bimoli 2L', 'kategori' => 'Sembako', 'harga' => 38000, 'stok' => 15, 'diskon_persen' => 5],
            ['nama_barang' => 'Gula Pasir Gulaku 1kg', 'kategori' => 'Sembako', 'harga' => 17500, 'stok' => 30, 'diskon_persen' => 0],
            ['nama_barang' => 'Telur Ayam (1kg)', 'kategori' => 'Sembako', 'harga' => 28000, 'stok' => 10, 'diskon_persen' => 0],

            // Kategori: Mi & Makanan Instan
            ['nama_barang' => 'Indomie Goreng Spesial', 'kategori' => 'Makanan', 'harga' => 3500, 'stok' => 100, 'diskon_persen' => 0],
            ['nama_barang' => 'Sedaap Mie Soto', 'kategori' => 'Makanan', 'harga' => 3200, 'stok' => 80, 'diskon_persen' => 0],

            // Kategori: Minuman
            ['nama_barang' => 'Aqua Galon 19L', 'kategori' => 'Minuman', 'harga' => 20000, 'stok' => 12, 'diskon_persen' => 0],
            ['nama_barang' => 'Teh Pucuk Harum 350ml', 'kategori' => 'Minuman', 'harga' => 4000, 'stok' => 48, 'diskon_persen' => 0],
            ['nama_barang' => 'Kopi Kapal Api Mix', 'kategori' => 'Minuman', 'harga' => 2500, 'stok' => 120, 'diskon_persen' => 0],

            // Kategori: Kebersihan & Mandi
            ['nama_barang' => 'Sabun Lifebuoy Merah', 'kategori' => 'Sabun', 'harga' => 5000, 'stok' => 25, 'diskon_persen' => 0],
            ['nama_barang' => 'Shampoo Pantene Sachet', 'kategori' => 'Sabun', 'harga' => 1000, 'stok' => 200, 'diskon_persen' => 0],
            ['nama_barang' => 'Deterjen Rinso 770g', 'kategori' => 'Sabun', 'harga' => 22000, 'stok' => 10, 'diskon_persen' => 10],
            ['nama_barang' => 'Pepsodent 190g', 'kategori' => 'Sabun', 'harga' => 15000, 'stok' => 20, 'diskon_persen' => 0],

            // Kategori: Bumbu Dapur
            ['nama_barang' => 'Garam Cap Kapal 250g', 'kategori' => 'Bumbu', 'harga' => 3000, 'stok' => 40, 'diskon_persen' => 0],
            ['nama_barang' => 'Royco Ayam Sachet', 'kategori' => 'Bumbu', 'harga' => 500, 'stok' => 500, 'diskon_persen' => 0],
        ];

        foreach ($barangs as $barang) {
            DB::table('barangs')->insert(array_merge($barang, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}