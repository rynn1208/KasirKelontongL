<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    // Beri tahu Laravel bahwa primary key kita adalah 'id_barang', bukan 'id'
    protected $primaryKey = 'id_barang';

    // Kolom yang diizinkan untuk diisi data (Mass Assignment)
    protected $fillable = ['nama_barang', 'kategori', 'harga', 'stok', 'diskon_persen'];
}