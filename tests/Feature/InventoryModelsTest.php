<?php

namespace Tests\Feature;

use App\Models\Barang;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InventoryModelsTest extends TestCase
{
    use RefreshDatabase;

    public function test_database_seeder_creates_barang_records(): void
    {
        $this->seed();
        $this->seed();

        $this->assertSame(5, Barang::count());
        $this->assertSame('Barang 1', Barang::where('kode_barang', 'BRG001')->firstOrFail()->nama_barang);
    }

    public function test_inventory_models_resolve_transaction_relations(): void
    {
        $barang = Barang::create([
            'kode_barang' => 'BRG001',
            'nama_barang' => 'Barang 1',
            'harga' => 10000,
            'stok' => 10,
        ]);
        $transaksi = Transaksi::create([
            'nomor_transaksi' => 'TRX001',
            'tanggal' => '2026-10-03',
            'total' => 10000,
        ]);
        $detail = DetailTransaksi::create([
            'transaksi_id' => $transaksi->id,
            'barang_id' => $barang->id,
            'jumlah' => 1,
            'harga' => 10000,
            'subtotal' => 10000,
        ]);

        $this->assertTrue($detail->barang->is($barang));
        $this->assertTrue($detail->transaksi->is($transaksi));
        $this->assertSame(1, $barang->detailTransaksis()->count());
        $this->assertSame(1, $transaksi->detailTransaksis()->count());
    }
}
