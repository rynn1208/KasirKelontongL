<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class LaporanController extends Controller
{
    public function index()
    {
        // Mengambil semua data transaksi, diurutkan dari yang terbaru (descending)
        $transaksis = Transaksi::orderBy('tanggal', 'desc')->get();

        return view('laporan.index', compact('transaksis'));
    }
}