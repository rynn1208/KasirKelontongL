<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung total seluruh pendapatan dari tabel transaksis
        $total_pendapatan = Transaksi::sum('total_bayar');

        // 2. Hitung jumlah transaksi yang pernah terjadi
        $jumlah_transaksi = Transaksi::count();

        // 3. Hitung total macam barang di etalase
        $total_barang = Barang::count();

        // 4. Deteksi barang yang stoknya 5 atau ke bawah
        $stok_menipis = Barang::where('stok', '<=', 5)->get();

        return view('dashboard', compact('total_pendapatan', 'jumlah_transaksi', 'total_barang', 'stok_menipis'));
    }
}