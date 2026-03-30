<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Session; // Wajib dipanggil untuk fitur Keranjang

class TransaksiController extends Controller
{
    // 1. Menampilkan Halaman Kasir
    public function index()
    {
        // Ambil semua barang yang stoknya masih ada
        $barangs = Barang::where('stok', '>', 0)->get();

        // Ambil data keranjang dari Session (jika kosong, jadikan array)
        $keranjang = Session::get('keranjang', []);

        $total_belanja = 0;
        foreach ($keranjang as $item) {
            $total_belanja += $item['harga'] * $item['jumlah'];
        }

        return view('transaksi.index', compact('barangs', 'keranjang', 'total_belanja'));
    }

    // 2. Memasukkan Barang ke Keranjang
    public function tambahKeranjang(Request $request)
    {
        $barang = Barang::findOrFail($request->id_barang);
        $keranjang = Session::get('keranjang', []);

        // Hitung harga setelah diskon (jika ada)
        $harga_diskon = $barang->harga - ($barang->harga * $barang->diskon_persen / 100);

        // Cek apakah barang sudah ada di keranjang
        if (isset($keranjang[$barang->id_barang])) {
            $jumlah_baru = $keranjang[$barang->id_barang]['jumlah'] + $request->jumlah;

            // Cek stok
            if ($jumlah_baru > $barang->stok) {
                return back()->with('error', 'Gagal! Sisa stok hanya ' . $barang->stok);
            }
            $keranjang[$barang->id_barang]['jumlah'] = $jumlah_baru;
        } else {
            // Cek stok untuk barang baru di keranjang
            if ($request->jumlah > $barang->stok) {
                return back()->with('error', 'Gagal! Sisa stok hanya ' . $barang->stok);
            }
            $keranjang[$barang->id_barang] = [
                'nama_barang' => $barang->nama_barang,
                'harga' => $harga_diskon,
                'jumlah' => $request->jumlah
            ];
        }

        // Simpan kembali ke Session
        Session::put('keranjang', $keranjang);
        return back()->with('success', 'Dimasukkan ke keranjang!');
    }

    // 3. Reset / Kosongkan Keranjang
    public function resetKeranjang()
    {
        Session::forget('keranjang');
        return back()->with('success', 'Keranjang dibersihkan.');
    }

    // 4. Proses Pembayaran (Checkout)
    public function bayar()
    {
        $keranjang = Session::get('keranjang');

        if (empty($keranjang)) {
            return back()->with('error', 'Keranjang masih kosong!');
        }

        $total_bayar = 0;

        // Loop untuk menghitung total dan MENGURANGI STOK di database
        foreach ($keranjang as $id_barang => $item) {
            $total_bayar += $item['harga'] * $item['jumlah'];

            $barang = Barang::find($id_barang);
            $barang->stok -= $item['jumlah'];
            $barang->save(); // Otomatis update ke tabel barangs
        }

        // Simpan ke tabel transaksis
        Transaksi::create([
            'total_bayar' => $total_bayar
        ]);

        // Bersihkan keranjang setelah sukses
        Session::forget('keranjang');

        return back()->with('success_bayar', 'Transaksi Sukses! Stok telah diupdate.');
    }
}