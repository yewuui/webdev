<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['kode_barang' => 'BRG001', 'nama_barang' => 'Barang 1', 'harga' => 10000, 'stok' => 10],
            ['kode_barang' => 'BRG002', 'nama_barang' => 'Barang 2', 'harga' => 20000, 'stok' => 5],
            ['kode_barang' => 'BRG003', 'nama_barang' => 'Barang 3', 'harga' => 15000, 'stok' => 8],
            ['kode_barang' => 'BRG004', 'nama_barang' => 'Barang 4', 'harga' => 25000, 'stok' => 3],
            ['kode_barang' => 'BRG005', 'nama_barang' => 'Barang 5', 'harga' => 30000, 'stok' => 7],
        ];

        foreach ($items as $item) {
            Barang::updateOrCreate(
                ['kode_barang' => $item['kode_barang']],
                $item
            );
        }
    }
}
