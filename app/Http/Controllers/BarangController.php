<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort_by = $request->input('sort', 'nama_barang');
        $order = $request->input('order', 'asc');

        $barangs = Barang::where('nama_barang', 'LIKE', "%{$search}%")
            ->orWhere('kategori', 'LIKE', "%{$search}%")
            ->orderBy($sort_by, $order)
            ->get();

        $next_order = ($order == 'asc') ? 'desc' : 'asc';

        // Alihkan dari array [] ke file tampilan Blade
        return view('barang.index', compact('barangs', 'search', 'sort_by', 'order', 'next_order'));
    }

    public function store(Request $request)
    {
        // Simpan ke database
        Barang::create([
            'nama_barang' => $request->nama_barang,
            'kategori' => $request->kategori,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'diskon_persen' => $request->diskon ?: 0
        ]);

        // Kembali ke halaman barang dengan membawa pesan sukses (Session)
        return redirect('/barang')->with('success', 'Produk baru telah ditambahkan ke etalase.');
    }

    // Menampilkan halaman form edit
    public function edit($id)
    {
        // findOrFail sangat canggih: akan otomatis menampilkan error 404 jika barang tidak ditemukan
        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    // Memproses penyimpanan data yang diedit
    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $barang->update([
            'nama_barang' => $request->nama_barang,
            'kategori' => $request->kategori,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'diskon_persen' => $request->diskon ?: 0
        ]);

        return redirect('/barang')->with('success', 'Data produk berhasil diperbarui!');
    }

    // Memproses penghapusan data
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect('/barang')->with('success', 'Produk berhasil dihapus dari etalase.');
    }
}